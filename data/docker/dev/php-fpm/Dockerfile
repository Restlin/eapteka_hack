FROM php:8.0-fpm-alpine

ENV LIBRARY_PATH=/lib:/usr/lib

RUN apk add --no-cache fcgi jpeg-dev zlib-dev libpng-dev freetype-dev libzip-dev cyrus-sasl-dev postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_pgsql pgsql gd intl zip

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./dev/php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR /app

COPY ./dev/php-fpm/entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint
