#!/bin/sh
set -e

# Default PORT to 80 if not provided by Render
PORT="${PORT:-80}"
echo "Configuring Apache to listen on port ${PORT}..."

# Update Apache port configuration for Render dynamic port binding
sed -i "s/Listen [0-9]*/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Ensure required Laravel storage and cache directories exist
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/database

# Provide a dummy SQLite file in case any package checks for a DB file
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
fi

# Ensure proper ownership and permissions for the web server user
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Auto-generate an ephemeral APP_KEY if one was not supplied via Render environment
if [ -z "$APP_KEY" ]; then
    echo "Notice: APP_KEY was not set in environment. Generating dynamic fallback key..."
    export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
fi

# Set safe production defaults if unset
export APP_ENV="${APP_ENV:-production}"
export APP_DEBUG="${APP_DEBUG:-false}"
export LOG_CHANNEL="${LOG_CHANNEL:-stderr}"
export SESSION_DRIVER="${SESSION_DRIVER:-file}"
export CACHE_STORE="${CACHE_STORE:-file}"
export DB_CONNECTION="${DB_CONNECTION:-sqlite}"
export DB_DATABASE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"

# Cache routes and views for optimal performance (without querying any database)
php artisan route:cache || true
php artisan view:cache || true

echo "EAGLE OS is ready. Starting Apache..."

exec "$@"
