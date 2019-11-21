FROM php:7.3-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y mariadb-client-10.3

RUN a2enmod rewrite
