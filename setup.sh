#!/bin/bash
# 1. Setup Environment Variables for Composer
export HOME=/root
export COMPOSER_HOME=/root

# 2. Install dependencies first
apt-get update
apt-get install -y php-cli unzip git composer nginx php8.3-fpm php8.3-mysql php8.3-xml php8.3-curl

# 3. Clean and Clone
rm -rf /var/www/html/*
# Clone directly into html folder (note the dot at the end)
git clone https://oauth2:${gitlab_token}@gitlab.com/dexterwebtech/brook-app.git /var/www/html

# 4. Check if clone actually worked before proceeding
if [ ! -f "/var/www/html/composer.json" ]; then
    echo "ERROR: Git clone failed. Directory is empty."
    exit 1
fi

cd /var/www/html

# 5. Laravel Setup
cp .env.example .env
sed -i "s/DB_HOST=127.0.0.1/DB_HOST=${db_host}/" .env
sed -i "s/DB_DATABASE=laravel/DB_DATABASE=${db_name}/" .env
sed -i "s/DB_PASSWORD=/DB_PASSWORD=${db_password}/" .env

# Use global composer, not .phar
composer install --no-interaction --optimize-autoloader

# 6. Permissions (Crucial for Laravel)
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

php artisan key:generate