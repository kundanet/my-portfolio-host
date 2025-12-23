FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Set document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy project
COPY . .

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data \
    storage bootstrap/cache database

# Run migrations (SQLite is already there)
RUN php artisan migrate --force

EXPOSE 80
CMD ["apache2-foreground"]
