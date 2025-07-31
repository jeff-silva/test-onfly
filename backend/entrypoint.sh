#!/bin/sh

composer install
chmod 0777 -R /app

if [ ! -f "/app/.env" ]; then
  cp "/app/.env.example" "/app/.env"
fi

if ! grep -q "^APP_KEY=." /app/.env; then
  php artisan key:generate
fi

php artisan migrate
php artisan db:seed
php artisan optimize

exec /usr/bin/supervisord -n -c /etc/supervisord.conf