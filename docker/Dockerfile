FROM php:8.1 as builder

RUN apt-get -y update && apt-get -y upgrade && apt-get -y install zlib1g-dev unzip libzip-dev

WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY artisan composer.json composer.lock ./

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --no-autoloader --no-dev --no-progress

COPY . .

RUN COMPOSER_ALLOW_SUPERUSER=1 composer dumpautoload --optimize

FROM node as node-builder

WORKDIR /app

COPY --from=builder /app /app

RUN npm ci && npm run build

FROM php:8.1-apache

RUN export DEBIAN_FRONTEND=noninteractive DEBCONF_NONINTERACTIVE_SEEN=true && apt-get -y update && apt-get -y install libpq-dev libpq5 && \
    docker-php-ext-install pdo_pgsql pgsql && \
    a2enmod rewrite headers && \
    apt purge -y libpq-dev && rm -rf /var/lib/apt/lists/*

COPY --from=node-builder /app /var/www/html/

RUN mv /var/www/html/docker/entrypoint /

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && echo "error_log = /dev/stderr" >> $PHP_INI_DIR/php.ini

ENTRYPOINT [ "/entrypoint" ]
CMD [ "apache2-foreground" ]
