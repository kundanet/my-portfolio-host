FROM php:8.2-apache

# System deps
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
 && docker-php-ext-install pdo pdo_sqlite zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Laravel public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy app
COPY . .

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# ✅ CREATE SQLITE FILE (THIS FIXES EVERYTHING)
RUN mkdir -p database \
 && touch database/database.sqlite \
 && chown -R www-data:www-data database storage bootstrap/cache

# Run migrations
RUN php artisan migrate --force || true

EXPOSE 80
CMD ["apache2-foreground"]
