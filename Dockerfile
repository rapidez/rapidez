FROM php:8.1-fpm-alpine

LABEL maintainer="Rapidez"
LABEL org.opencontainers.image.source=https://github.com/rapidez/rapidez
LABEL org.opencontainers.image.url=https://rapidez.io
LABEL org.opencontainers.image.documentation=https://docs.rapidez.io
LABEL org.opencontainers.image.vendor="Rapidez"
LABEL org.opencontainers.image.description="Headless Magento - with Laravel, Vue and Reactive Search"
LABEL org.opencontainers.image.licenses="GPL-3.0"

ENV COMPOSER_ALLOW_SUPERUSER=1

ARG WWWGROUP

WORKDIR /var/www/html

RUN apk add --update libpng-dev jpeg-dev libwebp-dev freetype-dev libmcrypt-dev gd-dev jpegoptim optipng pngquant gifsicle \
 && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
 && docker-php-ext-enable sodium \
 && docker-php-ext-install exif pdo pdo_mysql gd \
 && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
 && apk add --update nodejs npm yarn

COPY . /var/www/html/
RUN composer install \
    && echo "* * * * * cd /var/www/html && php artisan schedule:run" >> /etc/crontabs/root \
    && sed -i 's/protected $proxies;/protected $proxies = ["127.0.0.1\/8","172.17.0.0\/14"];/g' app/Http/Middleware/TrustProxies.php \
    && php artisan rapidez:install \
    && yarn && yarn run prod
