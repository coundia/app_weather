FROM php:7.4-apache
RUN mkdir /app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf 
WORKDIR /app
RUN chown -R www-data:www-data /app && a2enmod rewrite