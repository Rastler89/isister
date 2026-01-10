# =========================
# 1️⃣ Frontend builder (Vite)
# =========================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources resources
COPY vite.config.* ./
RUN npm run build
# =========================
# 2️⃣ Runtime con FrankenPHP
# =========================
FROM dunglas/frankenphp:alpine

# Instalamos extensiones de PHP necesarias
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    bcmath \
    exif \
    pcntl

# Configuramos el directorio de trabajo
WORKDIR /app

# Copiamos los archivos del proyecto
COPY . .
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --from=frontend /app/public/build public/build

# Instalamos dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# PERMISOS CRÍTICOS PARA LARAVEL
RUN chown -R www-data:www-data storage bootstrap/cache

# Indicamos que el Document Root es la carpeta public
ENV FRANKENPHP_CONFIG="root /app/public"

EXPOSE 80
EXPOSE 443

CMD ["frankenphp", "run-config", "/etc/caddy/Caddyfile"]