terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 5.0"
    }
  }
  # This empty block allows GitLab to inject the backend configuration automatically
  backend "http" {}
}

provider "aws" {
  region = "us-east-2" 
}