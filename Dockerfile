# ==============================================================================
# EAGLE OS - Production Dockerfile for Render Deployment
# Multi-stage build: Node.js (Vite frontend) + PHP 8.3 Apache (Laravel backend)
# ==============================================================================

# ------------------------------------------------------------------------------
# Stage 1: Build Frontend Assets (Vite + Tailwind CSS 4 + Alpine.js + ApexCharts)
# ------------------------------------------------------------------------------
FROM node:20-alpine AS frontend-builder

WORKDIR /app

# Copy dependency manifests first for layer caching
COPY package.json package-lock.json ./

# Install npm dependencies cleanly
RUN npm ci --prefer-offline --no-audit

# Copy application source code for frontend build
COPY . .

# Compile production assets (writes to /app/public/build)
RUN npm run build

# ------------------------------------------------------------------------------
# Stage 2: Production PHP 8.3 Apache Web Server
# ------------------------------------------------------------------------------
FROM php:8.3-apache

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND=noninteractive

# Install core system libraries and required PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        intl \
        opcache \
        pdo_sqlite \
        zip \
    && a2enmod rewrite headers \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install official Composer binary
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure Apache VirtualHost and PHP production settings
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/docker-php-custom.ini

# Copy application files (ignoring files specified in .dockerignore)
COPY . /var/www/html

# Copy compiled frontend assets from Stage 1
COPY --from=frontend-builder /app/public/build /var/www/html/public/build

# Install PHP dependencies without dev packages
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy and setup entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Prepare directory structures and set ownership for Apache (www-data)
RUN mkdir -p /var/www/html/storage/framework/cache/data \
             /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/storage/logs \
             /var/www/html/bootstrap/cache \
             /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Default port (Render sets the PORT environment variable dynamically)
EXPOSE 80

# Production environment defaults
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/var/www/html/database/database.sqlite

# Container healthcheck targeting the dedicated /healthz endpoint
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -f http://127.0.0.1:${PORT:-80}/healthz || exit 1

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
