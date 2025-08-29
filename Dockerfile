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
    
    # Copy application code
    COPY . .
    
    # Install PHP dependencies
    RUN composer install --no-dev --optimize-autoloader
    
    # Install frontend dependencies + build with Vite
    RUN npm install && npm run build
    
    # Laravel optimizations
    RUN php artisan config:cache \
     && php artisan route:cache \
     && php artisan view:cache
    
    # Fix storage & cache folder permissions
    RUN chown -R www-data:www-data storage bootstrap/cache
    
    # Expose HTTP port
    EXPOSE 80
    
    # Start: migrate DB then launch supervisor (nginx + php-fpm)
    CMD sh -c "php artisan migrate --force && supervisord -c /etc/supervisor/conf.d/supervisord.conf"
    