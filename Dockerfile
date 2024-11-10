FROM php:8.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite (for CodeIgniter)
RUN a2enmod rewrite

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose Apache's port
EXPOSE 80
