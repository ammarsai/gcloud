FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update -y && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libmcrypt-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring

# Set the working directory
WORKDIR /app

# Copy the composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-dev --optimize-autoloader

# Copy the entire Laravel project to the container
COPY . .

# Expose the port the app runs on
EXPOSE 8080

# Start the PHP application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
