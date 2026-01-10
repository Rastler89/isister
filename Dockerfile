FROM dunglas/frankenphp:alpine

# 1. Extensiones necesarias
RUN install-php-extensions pdo_mysql gd intl zip opcache bcmath exif pcntl

WORKDIR /app

# 2. Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 3. Dependencias
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-autoloader --ignore-platform-reqs

# 4. Código y permisos
COPY . .
RUN composer dump-autoload --optimize --no-dev
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 5. Configuración crítica: Forzamos el servidor a NO intentar SSL
# SERVER_NAME debe ser :80 para que no intente autogestionar certificados
ENV SERVER_NAME=:80
WORKDIR /app/public
COPY Caddyfile /etc/frankenphp/Caddyfile


EXPOSE 80

CMD ["frankenphp", "php-server"]