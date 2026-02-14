# 1. Security Group
resource "aws_security_group" "laravel_sg" {
  name = "laravel-sg"
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
resource "aws_db_instance" "laravel_db" {
  allocated_storage    = 20
  engine               = "mysql"
  instance_class       = "db.t3.micro"
  db_name              = "laravelapp"
  username             = "admin"
  password             = var.db_password
  vpc_security_group_ids = [aws_security_group.laravel_sg.id]
  skip_final_snapshot  = true
  publicly_accessible  = false
}

# 3. EC2 Server
resource "aws_instance" "laravel_web" {
  ami           = "ami-0c55b159cbfafe1f0" # Ubuntu 22.04
  instance_type = "t2.micro"
  vpc_security_group_ids = [aws_security_group.laravel_sg.id]

  user_data = templatefile("../setup.sh", {
    gitlab_token = var.gitlab_token,
    db_password  = var.db_password,
    db_host      = aws_db_instance.laravel_db.address,
    db_name      = aws_db_instance.laravel_db.db_name,
    repo_url     = "gitlab.com/your-username/your-project.git" # <-- CHANGE THIS
  })
}