FROM php:8.2-apache

# -----------------------------
# System dependencies
# -----------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    libzip-dev \
 && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# -----------------------------
# Apache rewrite
# -----------------------------
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# -----------------------------
# Work dir
# -----------------------------
WORKDIR /var/www/html

# -----------------------------
# Copy app source
# -----------------------------
COPY . .

# -----------------------------
# Composer install
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# Laravel required setup
# -----------------------------
RUN php artisan key:generate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link || true

# -----------------------------
# Permissions
# -----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache database

# -----------------------------
# Port
# -----------------------------
EXPOSE 80

CMD ["apache2-foreground"]
