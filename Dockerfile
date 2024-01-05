FROM php:8.2-apache
RUN apt update \
        && apt install -y \
            g++ \
            libicu-dev \
            libpq-dev \
            libzip-dev \
            zip \
            zlib1g-dev \
        && docker-php-ext-install \
            intl \
            opcache \
            pdo_mysql 

RUN apt-get install -y default-mysql-client
RUN a2enmod rewrite
RUN service apache2 restart

COPY ./src /var/www/laravello
WORKDIR /var/www/laravello

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
