# =========================
# 1️⃣ Builder PHP + Composer
# =========================
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-scripts \
    --optimize-autoloader

# =========================
# 2️⃣ Builder Frontend (Vite)
# =========================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources resources
COPY vite.config.* ./
RUN npm run build

# =========================
# 3️⃣ Runtime PHP (Producción)
# =========================
FROM php:8.2-fpm-alpine

# Dependencias del sistema
RUN apk add --no-cache \
    bash \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    jpeg-dev \
    freetype-dev

# Extensiones PHP necesarias para Laravel
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
 && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    intl \
    gd

WORKDIR /var/www/html

# Copiar código base
COPY . .

# Copiar vendor desde builder
COPY --from=vendor /app/vendor vendor

# Copiar frontend compilado
COPY --from=frontend /app/public/build public/build

# Permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
