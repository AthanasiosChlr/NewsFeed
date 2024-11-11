FROM php:8.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install required PHP extensions and other dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

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

# Debugging: List files in the working directory
RUN ls -la /var/www/html

# Debugging: Show contents of composer.json
RUN cat /var/www/html/composer.json

# Configure Git to allow the directory as a safe directory
RUN git config --global --add safe.directory /var/www/html

# Install PHP dependencies
RUN composer install --prefer-dist --optimize-autoloader --working-dir=/var/www/html

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose Apache's port
EXPOSE 80
