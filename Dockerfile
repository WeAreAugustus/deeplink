FROM php:8.2-apache

WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html
EXPOSE 5044
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
