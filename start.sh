#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Starting nginx..."
exec /start.sh