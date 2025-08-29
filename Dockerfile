# PHP + Nginx base image (Laravel ke liye)
FROM serversideup/php:8.2-fpm-nginx

# Working directory
WORKDIR /var/www/html

# Node install (Vite build ke liye)
RUN apt-get update && apt-get install -y \
    curl gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Composer dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Node dependencies (for vite)
COPY package*.json ./
RUN npm install && npm run build

# Copy all files
COPY . .

# Laravel optimize
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose web port
EXPOSE 80

# Start nginx + php-fpm
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
