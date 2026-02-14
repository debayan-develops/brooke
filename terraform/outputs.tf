output "laravel_site_url" {
  value = "http://${aws_instance.laravel_web.public_ip}"
}

output "db_endpoint" {
  value = aws_db_instance.laravel_db.endpoint
}