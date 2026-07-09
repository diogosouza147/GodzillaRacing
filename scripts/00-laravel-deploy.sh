#!/usr/bin/env bash

echo "Instalando dependências do Composer..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Cacheando configuração..."
php artisan config:cache

echo "Cacheando rotas..."
php artisan route:cache

echo "Cacheando views..."
php artisan view:cache

echo "Rodando migrations..."
php artisan migrate --force