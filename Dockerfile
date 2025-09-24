FROM php:8.4-fpm-alpine

LABEL maintainer="Rapidez"
LABEL org.opencontainers.image.source=https://github.com/rapidez/rapidez
LABEL org.opencontainers.image.url=https://rapidez.io
LABEL org.opencontainers.image.documentation=https://docs.rapidez.io
LABEL org.opencontainers.image.vendor="Rapidez"
LABEL org.opencontainers.image.description="Headless Magento - with Laravel, Tailwind CSS, Vue and InstantSearch"
LABEL org.opencontainers.image.licenses="GPL-3.0"

ARG WWWGROUP

WORKDIR /var/www/html

RUN apk add --update libpng-dev jpeg-dev libwebp-dev freetype-dev libmcrypt-dev gd-dev jpegoptim optipng pngquant gifsicle vim icu-dev \
 && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
 && docker-php-ext-configure opcache --enable-opcache \
 && docker-php-ext-configure intl \
 && docker-php-ext-enable sodium \
 #  Unforunately compiling imagemagick for php8.3 is broken https://github.com/Imagick/imagick/issues/640
 && apk add --update gcc make autoconf g++ imagemagick-dev && pecl install imagick && docker-php-ext-enable imagick \
 && docker-php-ext-install exif pdo pdo_mysql gd opcache intl \
 && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
 && apk add --update nodejs npm yarn \
 && echo "* * * * * cd /var/www/html && php artisan schedule:run" > /etc/crontabs/www-data

COPY . /var/www/html/
RUN chown www-data:www-data -R /var/www/html
USER www-data
RUN composer install \
    && php -r "file_exists('.env') || copy('.env.example', '.env');" \
    && sed -i -E 's/((APP|MAGENTO|ELASTICSEARCH)_(URL|HOST)=.*)/# \1/g' .env \
    && sed -i '/->withMiddleware(function \((Middleware \$middleware)\) {/a\'$'\n''        $middleware->trustProxies(["127.0.0.1/8","172.17.0.0/14"]);' bootstrap/app.php \
    && php artisan rapidez:install --frontendonly \
    && yarn && yarn run prod
