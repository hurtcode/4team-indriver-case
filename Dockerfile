FROM php:8.1-apache

COPY ./ ./

RUN cp /var/www/html/docker/site.conf /etc/apache2/sites-available/ && \
    a2dissite 000-default.conf && a2ensite site.conf && a2enmod rewrite

EXPOSE 80