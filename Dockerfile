FROM php:8.3-fpm-alpine

# Installer les dépendances système nécessaires
RUN apk add --no-cache nginx bash supervisor libpng-dev libjpeg-turbo-dev freetype-dev libwebp-dev libzip-dev oniguruma-dev curl-dev postgresql-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip mbstring bcmath exif

# Copier Laravel
WORKDIR /var/www/html
COPY . .

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Droits sur storage et bootstrap/cache pour PHP-FPM
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copier la config Nginx
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

# Exposer le port HTTP
EXPOSE 8080

# S'assurer que les fichiers tmp de Nginx sont accessibles
RUN mkdir -p /run/nginx \
    && chown -R www-data:www-data /run/nginx

# Lancer PHP-FPM et Nginx sous root mais PHP-FPM utilisera www-data
# Assurer que les répertoires de stockage existent et ont les bonnes permissions au runtime
CMD ["sh", "-c", "mkdir -p /var/www/html/storage/framework/views /var/www/html/storage/framework/sessions /var/www/html/storage/framework/cache /var/www/html/storage/logs /var/www/html/bootstrap/cache && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && php-fpm & nginx -g 'daemon off;'"]
