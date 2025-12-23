FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev \
 && docker-php-ext-install pdo pdo_sqlite zip

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 🔥 CREATE SQLITE FILE AT BUILD TIME
RUN mkdir -p database \
 && touch database/database.sqlite \
 && chown -R www-data:www-data database storage bootstrap/cache

# 🔥 RUN MIGRATIONS
RUN php artisan migrate --force

EXPOSE 80
CMD ["apache2-foreground"]
