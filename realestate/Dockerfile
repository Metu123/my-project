# Start from official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo_mysql zip sodium

# Install MongoDB extension
RUN pecl install mongodb && \
    echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Apache configuration for Laravel
COPY docker-apache.conf /etc/apache2/conf-available/laravel.conf
RUN a2enconf laravel

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions (you can tweak these as needed)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
