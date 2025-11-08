FROM php:8.3-fpm-alpine

# Installer Nginx et dépendances
RUN apk add --no-cache nginx bash supervisor libpng libjpeg libwebp freetype

# Copier Laravel
WORKDIR /var/www/html
COPY . .

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Droits
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copier la config Nginx
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf


# Exposer le port HTTP
EXPOSE 8080

# Lancer PHP-FPM et Nginx
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
