#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force
RUN php artisan storage:link

php artisan config:clear
php artisan config:cache

echo "Starting nginx..."
exec /start.sh