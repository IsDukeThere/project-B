FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 1. Salin SEMUA file project terlebih dahulu (termasuk artisan & composer.json)
COPY . /var/www

# 2. Baru jalankan composer install di dalam folder yang sudah lengkap isinya
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Beri hak akses untuk storage dan bootstrap cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Konfigurasi Apache Document Root ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

RUN a2enmod rewrite

EXPOSE 80