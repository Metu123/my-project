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
    nodejs \
    npm \
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

# Enable Apache rewrite module
RUN a2enmod rewrite

# Fix Apache to serve from /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Install MongoDB PHP extension (if needed)
RUN pecl install mongodb-1.20.0 \
    && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application code
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node modules and build assets
RUN npm install && npm run build

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
