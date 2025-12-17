FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    nodejs \
    npm \
 && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache document root to Laravel public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy project
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# IMPORTANT: Laravel optimizations
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

EXPOSE 80
CMD ["apache2-foreground"]
