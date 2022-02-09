FROM php:8.1.2-fpm

RUN apt-get update
RUN apt-get install libpq-dev -y
RUN docker-php-ext-install pdo pdo_pgsql