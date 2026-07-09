FROM composer:2 AS composer

FROM webdevops/php-nginx:8.3-alpine

ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=production
ENV APP_DEBUG=false

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

COPY docker/entrypoint.d/10-artisan.sh /opt/docker/provision/entrypoint.d/10-artisan.sh
RUN chmod +x /opt/docker/provision/entrypoint.d/10-artisan.sh \
    && chown -R application:application /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 80