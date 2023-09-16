# docker/php/Dockerfile
FROM php:8.2.1-fpm

RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd