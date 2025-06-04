# Use official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# ----------------------------
# Install system dependencies
# ----------------------------
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    unzip \
    git \
    curl \
    libssl-dev \
    pkg-config \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    zlib1g-dev \
    nano \
    vim \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libxslt-dev \
    nodejs \
    npm \
    && docker-php-ext-install zip pdo pdo_mysql intl xml gd

# ----------------------------
# Install MongoDB PHP Extension
# ----------------------------
RUN pecl install mongodb-1.20.0 \
    && docker-php-ext-enable mongodb

# ----------------------------
# Enable Apache Rewrite Module
# ----------------------------
RUN a2enmod rewrite

# ----------------------------
# Install Composer
# ----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ----------------------------
# Copy Laravel Codebase
# ----------------------------
COPY . .

# ----------------------------
# Set proper permissions
# ----------------------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# ----------------------------
# Install PHP dependencies
# ----------------------------
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ----------------------------
# Install Node dependencies & build frontend (Vite)
# ----------------------------
RUN npm install && npm run build

# ----------------------------
# Set Apache DocumentRoot to public/
# ----------------------------
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# ----------------------------
# Expose port and start Apache
# ----------------------------
EXPOSE 80
CMD ["apache2-foreground"]
