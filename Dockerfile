FROM php:8.1-apache

# Install MySQLi extension for PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the container
COPY . /var/www/html/

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80
