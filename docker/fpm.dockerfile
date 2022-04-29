FROM php:8.0.18-fpm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update
RUN apt-get install libpq-dev -y
RUN docker-php-ext-install pdo pdo_pgsql pgsql sockets

COPY ./ /var/www/symfony-docker
WORKDIR /var/www/symfony-docker
RUN composer install