FROM php:8.0-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nano \
    bash \
    && docker-php-ext-install zip gd mbstring pdo pdo_mysql xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Set correct ownership for the storage and bootstrap directories
# Ensure necessary directories exist and set the proper permissions for directories
RUN mkdir -p /var/www/html/absen/storage /var/www/html/absen/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/absen \
    && chmod -R 775 /var/www/html/absen/storage /var/www/html/absen/bootstrap/cache

# Make sure to run `composer install` to install dependencies
# RUN composer install --no-interaction --prefer-dist

CMD ["php-fpm"]
