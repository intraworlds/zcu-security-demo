FROM php:7.1-apache

# install additional core extension
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql
