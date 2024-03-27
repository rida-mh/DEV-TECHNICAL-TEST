FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
    zip \
    unzip \
    nano \
    libzip-dev \
    && docker-php-ext-install zip

RUN a2enmod rewrite

COPY --from=composer /usr/bin/composer /usr/bin/composer