#!/bin/bash
set -e

echo "Running migrations..."
php artisan config:clear
php artisan cache:clear
php artisan migrate --force
php artisan storage:link


echo "Starting nginx..."
exec /start.sh