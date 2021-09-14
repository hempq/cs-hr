FROM php:7.4-apache

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . .

RUN composer install