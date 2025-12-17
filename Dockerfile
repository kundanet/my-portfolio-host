FROM php:8.2-apache

# -----------------------------
# System dependencies
# -----------------------------
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
 && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# -----------------------------
# Enable Apache rewrite
# -----------------------------
RUN a2enmod rewrite

# -----------------------------
# Set Laravel public folder
# -----------------------------
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# -----------------------------
# Set working directory
# -----------------------------
WORKDIR /var/www/html

# -----------------------------
# Copy project files
# -----------------------------
COPY . .

# -----------------------------
# Install Composer
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader --no-interaction

# -----------------------------
# Build frontend assets
# -----------------------------
RUN npm install && npm run build

# -----------------------------
# FIX SQLite (IMPORTANT)
# -----------------------------
RUN mkdir -p database \
 && touch database/database.sqlite \
 && chown -R www-data:www-data database storage bootstrap/cache \
 && chmod -R 775 database storage bootstrap/cache

# -----------------------------
# Laravel cache (safe)
# -----------------------------
RUN php artisan config:clear || true
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# -----------------------------
EXPOSE 80

CMD ["apache2-foreground"]
