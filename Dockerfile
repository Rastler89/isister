# Stage 1: Build frontend assets
FROM node:18 AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Build PHP application
FROM dunglas/frankenphp:alpine AS app
WORKDIR /app

# Install PHP extensions
RUN install-php-extensions pdo_mysql gd intl zip opcache bcmath exif pcntl

# Copy composer files
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-dev --no-interaction --no-autoloader --ignore-platform-reqs

# Copy application files
COPY . .

# Copy frontend assets
COPY --from=frontend /app/public/build /app/public/build

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Set server name
ENV SERVER_NAME=:80

# Copy Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

EXPOSE 80 443 443/udp

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
