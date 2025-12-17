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
 && docker-php-ext-install pdo pdo_mysql zip

# -----------------------------
# Enable Apache rewrite
# -----------------------------
RUN a2enmod rewrite

# -----------------------------
# Set Apache document root to /public
# -----------------------------
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

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

# -----------------------------
# Install PHP dependencies
# -----------------------------
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# Build frontend (Vite)
# -----------------------------
RUN npm install && npm run build

# -----------------------------
# Fix permissions (VERY IMPORTANT)
# -----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache

# -----------------------------
# Expose port
# -----------------------------
EXPOSE 80

# -----------------------------
# Start Apache
# -----------------------------
CMD ["apache2-foreground"]
