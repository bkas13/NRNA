# Dockerfile
FROM php:7.4-apache

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git zip unzip

ADD . /var/www
ADD ./public /var/www/html

#creates folder if doesnot exist
WORKDIR /assets

WORKDIR /var/www

RUN cp .env.example .env

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
# set permission for apache
RUN chown -R www-data:www-data /var/www/storage/
RUN chown -R www-data:www-data /assets

# Create sym-link to public path
RUN ln -s /assets /var/www/html

ADD entrypoint.sh /var/www/html/
RUN chmod +x /var/www/html/entrypoint.sh
ENTRYPOINT ["/var/www/html/entrypoint.sh"]

