# ---- Base image with PHP + Nginx ----
FROM serversideup/php:8.2-fpm-nginx

# Set working directory
WORKDIR /var/www/html

# Install system dependencies + Node.js (for Vite build)
USER root
RUN apt-get update && apt-get install -y \
    curl gnupg \
 && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
 && apt-get install -y nodejs \
 && rm -rf /var/lib/apt/lists/*

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy package.json and build frontend with Vite
COPY package*.json ./
RUN npm install && npm run build

# Copy rest of application code
COPY . .

# Laravel optimizations
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Expose HTTP port
EXPOSE 80

# Start supervisor (manages nginx + php-fpm)
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
