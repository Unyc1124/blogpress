#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan storage:link

php artisan config:clear
php artisan config:cache

echo "Starting nginx..."
exec /start.sh