#!/bin/bash
set -e

echo "Clearing config..."
php artisan config:clear
php artisan cache:clear

echo "Running migrations..."
php artisan migrate --force

echo "Linking storage..."
php artisan storage:link || true

echo "Optimizing..."
php artisan optimize

echo "Starting nginx..."
exec /start.sh