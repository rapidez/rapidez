FROM php:8.1-fpm-alpine

LABEL maintainer="Rapidez"

ARG WWWGROUP

WORKDIR /var/www/html

RUN docker-php-ext-enable sodium
RUN docker-php-ext-install exif pdo pdo_mysql

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apk add --update nodejs npm yarn

RUN composer create-project rapidez/rapidez . \
    && php artisan rapidez:install \
    && yarn && yarn run prod
