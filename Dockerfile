FROM php:8.0-apache
WORKDIR /var/www/html

RUN docker-php-ext-install mysqli

COPY index.php index.php
COPY query.php query.php
COPY connect_db.php connect_db.php
COPY style.css style.css
COPY swiper.js swiper.js
COPY treehole.svg treehole.svg
COPY background.svg background.svg

EXPOSE 80