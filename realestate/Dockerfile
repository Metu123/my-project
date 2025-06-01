FROM php:8.2-apache

WORKDIR /var/www/html

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
    libxslt-dev \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs npm \
    && docker-php-ext-install zip pdo pdo_mysql intl xml gd

RUN pecl install mongodb-1.20.0 && docker-php-ext-enable mongodb

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN npm install && npm run build

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

COPY docker-apache.conf /etc/apache2/conf-available/laravel.conf
RUN a2enconf laravel

EXPOSE 80

CMD ["apache2-foreground"]
