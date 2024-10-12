FROM php:8.3-apache
# add configuration here as needed
RUN a2enmod rewrite

# PostgreSQL untuk PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Salin kode proyek ke dalam container
COPY ./php/src /var/www/html/

# Mengatur hak akses
RUN chown -R www-data:www-data /var/www/html/