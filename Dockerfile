FROM php:8.2-apache

# -------------------------------------------------
# 1) SYSTEM DEPENDENCIES
# -------------------------------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
 && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# -------------------------------------------------
# 2) APACHE SETTINGS
# -------------------------------------------------
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# -------------------------------------------------
# 3) WORKDIR + FILES
# -------------------------------------------------
WORKDIR /var/www/html
COPY . .

# -------------------------------------------------
# 4) INSTALL COMPOSER
# -------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# -------------------------------------------------
# 5) FRONTEND BUILD
# -------------------------------------------------
RUN npm install && npm run build

# -------------------------------------------------
# 6) PERMISSIONS
# -------------------------------------------------
RUN chown -R www-data:www-data storage bootstrap/cache

# -------------------------------------------------
# 7) PORT + STARTUP
# -------------------------------------------------
EXPOSE 80
CMD ["apache2-foreground"]
