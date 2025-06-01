# Use official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
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
    && docker-php-ext-install zip pdo pdo_mysql intl xml gd

# Install MongoDB PHP extension
RUN pecl install mongodb-1.20.0 \
    && docker-php-ext-enable mongodb

# Enable Apache rewrite module
RUN a2enmod rewrite

# Fix Apache 403 forbidden by updating DocumentRoot and config
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Also fix <Directory> block for /public to allow Laravel's index.php routing
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Install Composer (use official image as source)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app source code
COPY . .

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Install PHP dependencies (without dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Expose Apache
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
