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

# Install Node.js 20
RUN apk add --no-cache curl python3 make g++ && \
    curl -fsSL https://unofficial-builds.nodejs.org/download/release/v20.19.0/node-v20.19.0-linux-x64-musl.tar.gz | tar -xz -C /usr/local --strip-components=1

RUN npm install && npm run build

RUN composer install --no-dev --optimize-autoloader

RUN chmod +x /var/www/html/start.sh

CMD ["/bin/bash", "/var/www/html/start.sh"]