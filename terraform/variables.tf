variable "gitlab_token" {
  description = "Token to clone the repo"
  type        = string
  sensitive   = true
}

variable "db_password" {
  description = "RDS Root Password"
  type        = string
  sensitive   = true
}