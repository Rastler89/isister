FROM dunglas/frankenphp:alpine

# 1. Extensiones de PHP
RUN install-php-extensions \
    pdo_mysql gd intl zip opcache bcmath exif pcntl

WORKDIR /app

# 2. Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 3. Instalación de dependencias (Separado para caché)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-autoloader --ignore-platform-reqs

# 4. Copiar código y generar autoloader
COPY . .
RUN composer dump-autoload --optimize --no-dev

# 5. Permisos de Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# 6. Configuración del servidor
# Cambiamos el root del servidor a la carpeta public de Laravel
ENV SERVER_NAME=:80
ENV FRANKENPHP_CONFIG=""
WORKDIR /app/public

EXPOSE 80

# Usamos el entrypoint oficial que ya sabe manejar Laravel
CMD ["frankenphp", "php-server"]