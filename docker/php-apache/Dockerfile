FROM php:7.2-apache

RUN apt-get update

# Enable apache rewrite mode
RUN a2enmod rewrite 

#install some basic tools
RUN apt-get install -y \
        git \
        vim 


#setup composer
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer


#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip pdo_mysql mysqli


# Cean up
RUN apt-get clean

WORKDIR /var/www/html