# docker/php/Dockerfile
FROM php:8.0-fpm

# Enanble needed extension
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql mysqli

# Set working directory inside the docker container
WORKDIR /var/www/html

# Access port for PHP-FPM
EXPOSE 9000
