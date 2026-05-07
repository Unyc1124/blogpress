#!/bin/bash
set -e

php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache

/start.sh  # richarvey image's entrypoint