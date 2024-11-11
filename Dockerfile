FROM php:8.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install required PHP extensions and other dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    vim \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (for CodeIgniter)
RUN a2enmod rewrite

# Set the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure DirectoryIndex
RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" >> /etc/apache2/apache2.conf

# Configure Apache to allow .htaccess files and set permissions
RUN echo "<Directory /var/www/html>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>" >> /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . /var/www/html

# Set the correct permissions and ownership for the .htaccess file and parent directories
RUN chmod 644 /var/www/html/.htaccess \
    && chown www-data:www-data /var/www/html/.htaccess \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chown -R www-data:www-data /var/www/html

# Install PHP dependencies
RUN composer install --prefer-dist --optimize-autoloader --working-dir=/var/www/html

# Expose Apache's port
EXPOSE 80