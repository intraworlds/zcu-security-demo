FROM php:apache

# copy just composer definitions
COPY composer.* /var/www/

# install deps
RUN set -ex; \
    apt-get update && apt-get install -y --no-install-recommends git unzip; \
    docker-php-ext-install -j$(nproc) pdo_mysql; \
    cd /var/www/; \
    curl https://getcomposer.org/download/1.5.2/composer.phar --output composer.phar; \
    php composer.phar install; \
    php composer.phar clear-cache; \
    rm composer.phar; \
    apt-get purge -y git unzip; \
    rm -r /var/lib/apt/lists/*

# enable apache modules
RUN a2enmod rewrite

