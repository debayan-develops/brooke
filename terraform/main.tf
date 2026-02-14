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

# 3. EC2 Server
resource "aws_instance" "brooke_web" {
  ami           = "ami-0c55b159cbfafe1f0" # Ubuntu 22.04
  instance_type = "t2.micro"
  vpc_security_group_ids = [aws_security_group.brooke_web_sg.id]

  user_data = templatefile("../setup.sh", {
    gitlab_token = var.gitlab_token,
    db_password  = var.db_password,
    db_host      = aws_db_instance.brooke_web_db.address,
    db_name      = aws_db_instance.brooke_web_db.db_name,
    repo_url     = "https://gitlab.com/dexterwebtech/brook-app.git" # <-- CHANGE THIS
  })
}