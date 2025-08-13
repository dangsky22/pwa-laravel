# Gunakan versi PHP yang sesuai dengan proyek Anda (misal: 8.2 atau 8.3)
FROM php:8.2-fpm-alpine

# Set direktori kerja
WORKDIR /var/www/html

# Instal dependencies sistem yang diperlukan termasuk ICU
RUN apk add --no-cache \
    linux-headers \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    mysql-client

# Configure dan instal ekstensi PHP
RUN docker-php-ext-configure intl --enable-intl && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    bcmath \
    sockets \
    intl \
    zip \
    opcache

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file composer terlebih dahulu untuk caching
COPY composer.json composer.lock ./

# Instal dependensi tanpa dev packages untuk produksi
RUN composer install --no-dev --no-interaction --no-scripts --optimize-autoloader

# Salin sisa file aplikasi Anda
COPY . .

# Jalankan post-install scripts Laravel
RUN composer run-script post-install-cmd --no-interaction || true

# Set permission yang benar untuk storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Konfigurasi PHP untuk produksi
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini

# Expose port untuk web server
EXPOSE 9000

# Perintah untuk menjalankan PHP-FPM
CMD ["php-fpm"]