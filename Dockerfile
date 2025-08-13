FROM php:8.3-apache

# Set direktori kerja
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure intl && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    zip \
    opcache

# Enable Apache modules
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Create necessary directories
RUN mkdir -p storage/logs storage/framework/{cache,sessions,views} bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Configure Apache
RUN echo '<VirtualHost *:$PORT>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Startup script
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Set port from environment\n\
PORT=${PORT:-8080}\n\
echo "Starting Apache on port $PORT"\n\
\n\
# Update Apache configuration\n\
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf\n\
sed -i "s/\$PORT/$PORT/g" /etc/apache2/sites-available/000-default.conf\n\
echo "ServerName localhost" >> /etc/apache2/apache2.conf\n\
\n\
# Wait for database to be ready\n\
echo "Waiting for database connection..."\n\
php artisan tinker --execute="DB::connection()->getPdo();" || sleep 10\n\
\n\
# Run database migrations\n\
echo "Running database migrations..."\n\
php artisan migrate --force\n\
\n\
# Create sessions table if using database sessions\n\
php artisan session:table || true\n\
php artisan migrate --force\n\
\n\
# Clear Laravel caches\n\
php artisan config:clear || true\n\
php artisan route:clear || true\n\
php artisan view:clear || true\n\
php artisan cache:clear || true\n\
\n\
# Start Apache\n\
exec apache2-foreground' > /start.sh && chmod +x /start.sh

# PHP production config
RUN echo 'opcache.enable=1\n\
opcache.memory_consumption=128\n\
opcache.interned_strings_buffer=8\n\
opcache.max_accelerated_files=4000\n\
opcache.revalidate_freq=2\n\
opcache.fast_shutdown=1' > /usr/local/etc/php/conf.d/opcache.ini

CMD ["/start.sh"]