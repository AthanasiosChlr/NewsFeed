FROM php:8.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite (for CodeIgniter)
RUN a2enmod rewrite

# Set the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure DirectoryIndex
RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" >> /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . /var/www/html

# Install PHP dependencies
RUN cd /var/www/html && composer install --no-dev --prefer-dist --optimize-autoloader

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose Apache's port
EXPOSE 80
