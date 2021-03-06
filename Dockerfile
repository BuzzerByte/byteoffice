FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN apk add --update \ 
        libpng-dev \
		libzip-dev 

RUN docker-php-ext-install pdo pdo_mysql gd zip
