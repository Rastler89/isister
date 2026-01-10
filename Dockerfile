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

# 1. Instalamos las extensiones más comunes que Laravel suele pedir
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

# 2. Copiamos Composer desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 3. Copiamos los archivos de dependencias primero
COPY composer.json composer.lock ./

# 4. Instalamos ignorando requisitos de plataforma para evitar el Exit Code 2
RUN composer install --no-dev --no-interaction --no-autoloader --ignore-platform-reqs

# 5. Copiamos el resto del código
COPY . .
COPY --from=frontend /app/public/build public/build

# 6. Generamos el autoloader final y permisos
RUN composer dump-autoload --optimize --no-dev
RUN chown -R www-data:www-data storage bootstrap/cache

ENV FRANKENPHP_CONFIG="root /app/public"

EXPOSE 80
CMD ["frankenphp", "run-config", "/etc/caddy/Caddyfile"]