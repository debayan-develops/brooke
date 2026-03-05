output "brooke_site_url" {
  value = "http://${aws_instance.brooke_web.public_ip}"
}

output "db_endpoint" {
  value = aws_db_instance.brooke_web_db.endpoint
}