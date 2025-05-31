# Use official PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    && docker-php-ext-install pdo mbstring zip

# Install MongoDB PHP driver
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app to container
COPY . .

# Copy .env.example to .env for build-time requirements
COPY .env.example .env

# Install Composer (from Composer official image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies with maximum verbosity
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist -vvv

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port
EXPOSE 8000

# Start Apache server
CMD ["apache2-foreground"]
