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
# 2️⃣ Runtime PHP (Producción)
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

# Extensiones PHP necesarias para Laravel + dependencias reales
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
 && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    intl \
    gd \
    bcmath \
    opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar código
COPY . .

# Instalar dependencias PHP (ya con TODAS las extensiones)
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader

# Copiar frontend compilado
COPY --from=frontend /app/public/build public/build

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
