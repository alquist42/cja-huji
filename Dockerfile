FROM composer:1.5.1 AS composer
FROM php:5.6.4-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql mbstring
RUN apt-get -y update && apt-get install -y git unzip zip

RUN mkdir -p /var/www

WORKDIR /var/www
