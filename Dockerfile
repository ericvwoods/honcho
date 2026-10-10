# Honcho web app: PHP 8.2 + Apache, same PHP version as the XAMPP install.
# Code only; settings come from environment variables (see .env.example),
# uploads and the database live outside the image (Compose volumes).
FROM php:8.2-apache

# PHP extensions: mysqli/pdo_mysql (database), gd and zip (PhpSpreadsheet,
# images). mbstring, fileinfo, xml and curl are already in the base image.
RUN apt-get update \
 && apt-get install -y --no-install-recommends libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" mysqli pdo_mysql gd zip \
 && rm -rf /var/lib/apt/lists/*

# Apache: the .htaccess files do the routing, so allow them; headers for the CSP line
COPY docker/apache-honcho.conf /etc/apache2/conf-available/honcho.conf
RUN a2enmod rewrite headers && a2enconf honcho

COPY docker/php.ini /usr/local/etc/php/conf.d/honcho.ini
COPY --chown=www-data:www-data . /var/www/html/
