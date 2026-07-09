#!/bin/sh
set -e

echo "Cacheando configuração..."
php artisan config:cache

echo "Cacheando rotas..."
php artisan route:cache

echo "Cacheando views..."
php artisan view:cache

echo "Rodando migrations..."
php artisan migrate:fresh --force