#!/bin/bash
# Install Stack
add-apt-repository -y ppa:ondrej/php
apt-get update -y
apt-get install -y nginx php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-mbstring unzip git

# Deploy Code
cd /var/www
git clone https://oauth2:${gitlab_token}@${repo_url} html
cd html

# Configure Laravel
cp .env.example .env
sed -i "s/DB_HOST=.*/DB_HOST=${db_host}/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=${db_name}/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=admin/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${db_password}/" .env

# Install Dependencies
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader

# Permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Nginx config
cat <<EOT > /etc/nginx/sites-available/default
server {
    listen 80;
    root /var/www/html/public;
    index index.php;
    location / { try_files \$uri \$uri/ /index.php?\$query_string; }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }
}
EOT
systemctl restart nginx