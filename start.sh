#!/bin/bash
set -e

echo "Running migrations..."
php artisan config:clear
php artisan cache:clear
php artisan migrate --force



echo "Starting nginx..."
exec /start.sh