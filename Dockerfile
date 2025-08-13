# Gunakan PHP dengan Apache yang sudah terintegrasi
FROM php:8.3-apache

# Set direktori kerja
WORKDIR /var/www/html

# Instal dependencies sistem
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    default-mysql-client \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Configure dan instal ekstensi PHP
RUN docker-php-ext-configure intl && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    bcmath \
    sockets \
    intl \
    zip \
    opcache

# Enable Apache modules
RUN a2enmod rewrite

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin composer files
COPY composer.json ./
COPY composer.lock* ./

# Install dependencies
RUN composer update --no-dev --no-interaction --no-scripts --optimize-autoloader

# Salin aplikasi
COPY . .

# Buat direktori yang dibutuhkan
RUN mkdir -p storage/logs storage/framework/{cache,sessions,views} bootstrap/cache

# Laravel commands
RUN php artisan config:clear || true && \
    php artisan route:clear || true && \
    php artisan view:clear || true && \
    php artisan cache:clear || true

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Konfigurasi Apache untuk Laravel
RUN echo '<VirtualHost *:8080>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Update Apache ports
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf

# Konfigurasi PHP
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini

# Railway port
EXPOSE 8080

# Jalankan Apache
CMD ["apache2-foreground"]