FROM php:8.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_pgsql pgsql

COPY ./ ./

RUN cp /var/www/html/docker/site.conf /etc/apache2/sites-available/ && \
    a2dissite 000-default.conf && a2ensite site.conf && a2enmod rewrite

RUN chmod -R 777 /var/www/html

EXPOSE 80