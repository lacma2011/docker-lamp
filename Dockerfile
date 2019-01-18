#debian stretch
FROM php:7.3-apache

RUN mkdir /etc/apache2/ssl && \
    openssl req \
        -x509 \
        -nodes \
	-days 365 \
        -newkey rsa:2048 \
        -keyout /etc/apache2/ssl/server.key \
        -out /etc/apache2/ssl/server.crt \
        -subj "/C=US/ST=california/L=los angeles/O=my place/OU=my department/CN=homestead.docker"

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo mbstring
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
RUN a2enmod ssl
