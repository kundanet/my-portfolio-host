FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    nodejs \
    npm \
 && docker-php-ext-install pdo pdo_sqlite zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Laravel public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy project
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend (Tailwind / Vite)
RUN npm install && npm run build

# Create SQLite database
RUN mkdir -p database \
 && touch database/database.sqlite

# Permissions (THIS FIXES 500)
RUN chown -R www-data:www-data storage bootstrap/cache database \
 && chmod -R 775 storage bootstrap/cache database

EXPOSE 80

CMD ["apache2-foreground"]
