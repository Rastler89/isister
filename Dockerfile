# Stage 1: Runtime con FrankenPHP
FROM dunglas/frankenphp:alpine

# Instalamos extensiones de PHP necesarias para Laravel
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    bcmath \
    exif \
    pcntl

WORKDIR /app

# Copiamos Composer desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiamos archivos de dependencias primero para optimizar la caché
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-autoloader --ignore-platform-reqs

# Copiamos el resto del proyecto
COPY . .

# Finalizamos la instalación de Composer y damos permisos
RUN composer dump-autoload --optimize --no-dev
RUN chown -R www-data:www-data storage bootstrap/cache

# Configuramos el Document Root de FrankenPHP a la carpeta public de Laravel
ENV FRANKENPHP_CONFIG="root /app/public"

EXPOSE 80