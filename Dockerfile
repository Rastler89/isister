FROM dunglas/frankenphp:alpine

# 1. Instalamos las extensiones necesarias
RUN install-php-extensions \
    pdo_mysql gd intl zip opcache bcmath exif pcntl

# 2. Seteamos el directorio de trabajo directamente en public
# FrankenPHP busca por defecto el index.php en el directorio actual
WORKDIR /app

# 3. Instalamos Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Copiamos solo archivos de dependencias para aprovechar la caché
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-autoloader --ignore-platform-reqs

# 5. Copiamos el resto del proyecto
COPY . .

# 6. Generamos el autoloader y limpiamos
RUN composer dump-autoload --optimize --no-dev

# 7. PERMISOS: FrankenPHP corre como root por defecto en Docker, 
# pero Laravel necesita escribir en storage.
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 8. CONFIGURACIÓN DE SERVER
# No usamos FRANKENPHP_CONFIG para evitar errores de sintaxis.
# Simplemente le decimos a FrankenPHP que sirva la carpeta public.
ENV SERVER_NAME=:80
WORKDIR /app/public
COPY Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80