FROM richarvey/nginx-php-fpm:3.1.6

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

# Install Node.js
RUN apk add --no-cache nodejs npm

RUN npm install && npm run build

RUN composer install --no-dev --optimize-autoloader

RUN chmod +x /var/www/html/start.sh

CMD ["/bin/bash", "/var/www/html/start.sh"]