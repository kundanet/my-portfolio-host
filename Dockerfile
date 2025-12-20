FROM php:8.2-apache

# Install system packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
 && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Set document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . .

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# create writable sqlite file
RUN mkdir -p /var/www/html/storage/database
RUN touch /var/www/html/storage/database/database.sqlite
RUN chown -R www-data:www-data storage bootstrap/cache

RUN php artisan key:generate --force
RUN php artisan config:clear

EXPOSE 80

CMD ["apache2-foreground"]
