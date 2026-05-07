FROM node:20-alpine AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM richarvey/nginx-php-fpm:3.1.6

COPY --from=node_builder /app/public/build /var/www/html/public/build
COPY . /var/www/html

WORKDIR /var/www/html

ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-dev --optimize-autoloader
RUN chmod +x /var/www/html/start.sh

CMD ["/bin/bash", "/var/www/html/start.sh"]