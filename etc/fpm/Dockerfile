FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www/app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pdo_mysql

COPY ./conf/php.ini-development /usr/local/etc/php/php.ini

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer Commands
RUN useradd -ms /bin/bash pascalallen
RUN chown -R pascalallen:pascalallen /var/www/app
