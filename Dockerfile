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

# Apache: the .htaccess files do the routing, so allow them; headers for the CSP line.
# zz- so it loads after Debian's security.conf and its ServerTokens wins.
COPY docker/apache-honcho.conf /etc/apache2/conf-available/zz-honcho.conf
RUN a2enmod rewrite headers && a2enconf zz-honcho

COPY docker/php.ini /usr/local/etc/php/conf.d/honcho.ini
COPY --chown=www-data:www-data . /var/www/html/
# base image leaves the web root world-writable; Apache's own user is enough
RUN chmod 755 /var/www/html

# Upload folders: keep a copy of their committed files for the entrypoint
COPY docker/persistent-dirs /opt/honcho-seed/dirs
RUN grep -v '^#' /opt/honcho-seed/dirs | while read -r d; do \
        [ -n "$d" ] || continue; \
        mkdir -p "/opt/honcho-seed/$d" "/var/www/html/$d"; \
        cp -a "/var/www/html/$d/." "/opt/honcho-seed/$d/"; \
    done
COPY --chmod=755 docker/entrypoint.sh /usr/local/bin/honcho-entrypoint
ENTRYPOINT ["honcho-entrypoint"]
CMD ["apache2-foreground"]
