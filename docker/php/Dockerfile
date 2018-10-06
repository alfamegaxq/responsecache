FROM php:7.2

RUN apt-get update && apt-get install -y zlib1g-dev libxml2-dev

RUN docker-php-ext-install json mbstring opcache zip bcmath xml soap intl pdo dom posix pdo_mysql \
    && apt-get update \
    && yes | apt-get install curl \
    && yes | apt-get install git \
    && yes | apt-get install vim \
    && yes | apt-get install nano \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN yes | apt-get install libcurl4-openssl-dev pkg-config libssl-dev

RUN yes | pecl install xdebug \
&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN useradd -ms /bin/bash docker

USER docker

WORKDIR /var/www/html
