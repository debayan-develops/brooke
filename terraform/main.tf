# 1. Security Group
resource "aws_security_group" "brooke_web_sg" {
  name = "brooke-web-sg"
  ingress { 
    from_port = 80 
    to_port = 80 
    protocol = "tcp" 
    cidr_blocks = ["0.0.0.0/0"] 
    }
  ingress { 
    from_port = 22
    to_port = 22
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"] 
    }
  ingress { 
    from_port = 3306
    to_port = 3306
    protocol = "tcp"
    self = true 
    }
  egress { 
    from_port = 0
    to_port = 0
    protocol = "-1"
    cidr_blocks = ["0.0.0.0/0"] 
    }
}

# 2. RDS Database
resource "aws_db_instance" "brooke_web_db" {
  allocated_storage    = 20
  engine               = "mysql"
  instance_class       = "db.t3.micro"
  db_name              = "brooke_db"
  username             = "admin"
  password             = var.db_password
  vpc_security_group_ids = [aws_security_group.brooke_web_sg.id]
  skip_final_snapshot  = true
  publicly_accessible  = false
}

resource "aws_key_pair" "brooke_deployer" {
  key_name   = "Brooke_web_deployer"
  public_key = "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC9/PC+/U3pOI+fP+o+GAH6F91K9U75emZ99L8SSuvjchtYLjQ3s7ue65t6xSyNg30TEPTmRY/4cMIVcMiZ6QklIYWoyBk1xW0L5xy/Ljw7mCvL9dHk6nicIl5rhF+Dbm5rW/spUQOoKGoqrx5umQddbBTLUhxuS/TWpP9NdvoxGzQRIy+jRCLlAW3gWO+E7SiHRYY/hpHt/nVxMzhV+NT9tZGOj25dr5TaBmjEVdh6kOLQtAUa7Yz0kuQUkhWF4DsVCDTPutj1AhAjhRXhbuNyV9YU13YWoxAwfayG/ThD/cwOfoMR7v6xpjzRA0psOaehsy/urx2A1m873z4386l/"
}

# 3. EC2 Server
# resource "aws_instance" "brooke_web" {
#   ami           = "ami-0c55b159cbfafe1f0" # Ubuntu 22.04
#   instance_type = "t2.micro"
#   vpc_security_group_ids = [aws_security_group.brooke_web_sg.id]

#   user_data = templatefile("../setup.sh", {
#     gitlab_token = var.gitlab_token,
#     db_password  = var.db_password,
#     db_host      = aws_db_instance.brooke_web_db.address,
#     db_name      = aws_db_instance.brooke_web_db.db_name,
#     repo_url     = "https://gitlab.com/dexterwebtech/brook-app.git" # <-- CHANGE THIS
#   })

  # 1. Automatically find the latest Free Tier Ubuntu 24.04 image
data "aws_ami" "ubuntu" {
  most_recent = true
  owners      = ["099720109477"] # Official Canonical ID

  filter {
    name   = "name"
    values = ["ubuntu/images/hvm-ssd-gp3/ubuntu-noble-24.04-amd64-server-*"]
  }
}

# 2. Create the Free Tier Server
resource "aws_instance" "brooke_web" {
  ami           = data.aws_ami.ubuntu.id
  instance_type = "t3.micro" # Standard Free Tier in us-east-2 (2026)
  key_name      = aws_key_pair.brooke_deployer.key_name
  
  vpc_security_group_ids = [aws_security_group.brooke_web_sg.id]

  user_data = templatefile("../setup.sh", {
    gitlab_token = var.gitlab_token,
    db_password  = var.db_password,
    db_host      = aws_db_instance.brooke_web_db.address,
    db_name      = aws_db_instance.brooke_web_db.db_name,
    repo_url     = "https://gitlab.com/dexterwebtech/brook-app.git"
  })

# user_data = templatefile("${path.module}/../setup.sh", {
#     gitlab_token = var.gitlab_token,
#     db_password  = var.db_password,
#     db_host      = aws_db_instance.brooke_web_db.address,
#     db_name      = aws_db_instance.brooke_web_db.db_name
# })

  tags = {
    Name = "Brooke-Web"
  }

  
}
