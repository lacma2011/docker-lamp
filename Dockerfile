#debian stretch
FROM php:7.3-apache


RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo mbstring
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
