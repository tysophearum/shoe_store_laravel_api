# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install required dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files for better caching
COPY composer.json composer.lock ./

# Set the COMPOSER_ALLOW_SUPERUSER environment variable
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install application dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the local source code to the container
COPY . .

# Generate autoload files and optimize Composer autoloader
RUN composer dump-autoload --optimize

# Set the proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan migrate:fresh && php artisan storage:link && php artisan db:seed

# Expose port 80
EXPOSE 80

# Specify the command to run on container start
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
