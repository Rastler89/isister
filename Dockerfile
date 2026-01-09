# --- 1️⃣ Base image ---
FROM php:8.2-fpm

# --- 2️⃣ Instalar extensiones necesarias ---
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    curl \
    && docker-php-ext-install pdo_mysql zip mbstring gd

# --- 3️⃣ Instalar Composer globalmente ---
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- 4️⃣ Crear usuario para la app ---
RUN useradd -ms /bin/bash laravel
WORKDIR /var/www/laravel

# --- 5️⃣ Copiar proyecto (si quieres build local) ---
# COPY . /var/www/laravel

# --- 6️⃣ Configurar permisos ---
RUN chown -R laravel:laravel /var/www/laravel
USER laravel

# --- 7️⃣ Exponer puerto FPM ---
EXPOSE 9000

# --- 8️⃣ Entrypoint: actualizar dependencias y arrancar ---
# Se puede usar para Dokploy, que haga pull y build al iniciar
ENTRYPOINT ["sh", "-c", "\
    echo 'Desplegando Laravel...'; \
    composer install --optimize-autoloader --no-dev; \
    npm install && npm run build; \
    php artisan migrate --force; \
    php-fpm \
"]
