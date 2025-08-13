# Gunakan versi PHP yang sesuai dengan proyek Anda (misal: 8.2 atau 8.3)
# Base image "-alpine" lebih ringan dan direkomendasikan
FROM php:8.2-fpm-alpine

# Set direktori kerja
WORKDIR /var/www/html

# Instal ekstensi PHP yang umum dibutuhkan Laravel & Filament
# Termasuk intl dan zip yang menjadi penyebab error Anda
RUN docker-php-ext-install pdo pdo_mysql bcmath sockets intl zip

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file composer terlebih dahulu untuk caching
COPY composer.json composer.lock ./

# Instal dependensi tanpa dev packages untuk produksi
RUN composer install --no-dev --no-interaction --no-scripts --optimize-autoloader

# Salin sisa file aplikasi Anda
COPY . .

# Set permission yang benar untuk storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port untuk web server
EXPOSE 9000

# Perintah untuk menjalankan PHP-FPM
CMD ["php-fpm"]