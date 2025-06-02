FROM php:8.2-apache

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    gnupg \
    build-essential \
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
    libxslt-dev \
    pkg-config \
    libssl-dev

# Setup Node.js 18 repository properly
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -

# Install Node.js and npm
RUN apt-get install -y nodejs

# Install PHP extensions after dependencies installed
RUN docker-php-ext-install zip pdo pdo_mysql intl xml gd

# Enable Apache mod_rewrite (required for Laravel routes)
RUN a2enmod rewrite

# Copy custom Apache configuration to container
COPY docker-apache.conf /etc/apache2/conf-available/laravel.conf
RUN a2enconf laravel

# Set working directory inside the container
WORKDIR /var/www/html

# Copy application files into container
COPY . .

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies (you can do this on the host too if preferred)
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel storage and bootstrap cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port 80 for web traffic
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
