FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions and required system packages
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Change document root to /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . /var/www/html

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear Laravel cache (IMPORTANT!)
RUN php artisan config:clear
RUN rm -f bootstrap/cache/config.php
# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose the port Apache will run on
EXPOSE 5044

# Start Apache
CMD ["apache2-foreground"]
