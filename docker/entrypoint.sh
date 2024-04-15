#!/bin/bash

set -e

cd /var/www/html/

if [[ -f .env ]]; then
    echo "=== Remove old environment file ==="
        rm /var/www/html/.env
        echo "[ DONE ]"
    echo
fi

echo "=== Create new environment file ==="
    cp /var/www/html/.env.example /var/www/html/.env
echo "[ DONE ]"
echo

echo "=== Set environment values if any ==="

[[ -v APP_NAME ]] && sed -i "s,APP_NAME=.*$,APP_NAME=${APP_NAME},g" .env
[[ -v APP_ENV ]] && sed -i "s,APP_ENV=.*$,APP_ENV=${APP_ENV},g" .env
[[ -v APP_KEY ]] && sed -i "s,APP_KEY=.*$,APP_KEY=${APP_KEY},g" .env
[[ -v APP_DEBUG ]] && sed -i "s,APP_DEBUG=.*$,APP_DEBUG=${APP_DEBUG},g" .env
[[ -v APP_URL ]] && sed -i "s,APP_URL=.*$,APP_URL=${APP_URL},g" .env
[[ -v APP_TIMEZONE ]] && sed -i "s,APP_TIMEZONE=.*$,APP_TIMEZONE=${APP_TIMEZONE},g" .env

[[ -v LOG_CHANNEL ]] && sed -i "s,LOG_CHANNEL=.*$,LOG_CHANNEL=${LOG_CHANNEL},g" .env
[[ -v LOG_LEVEL ]] && sed -i "s,LOG_LEVEL=.*$,LOG_LEVEL=${LOG_LEVEL},g" .env

[[ -v DB_CONNECTION ]] && sed -i "s,DB_CONNECTION=.*$,DB_CONNECTION=${DB_CONNECTION},g" .env
[[ -v DB_HOST ]] && sed -i "s,DB_HOST=.*$,DB_HOST=${DB_HOST},g" .env
[[ -v DB_PORT ]] && sed -i "s,DB_PORT=.*$,DB_PORT=${DB_PORT},g" .env
[[ -v DB_DATABASE ]] && sed -i "s,DB_DATABASE=.*$,DB_DATABASE=${DB_DATABASE},g" .env
[[ -v DB_USERNAME ]] && sed -i "s,DB_USERNAME=.*$,DB_USERNAME=${DB_USERNAME},g" .env
[[ -v DB_PASSWORD ]] && sed -i "s,DB_PASSWORD=.*$,DB_PASSWORD=${DB_PASSWORD},g" .env

[[ -v BROADCAST_DRIVER ]] && sed -i "s,BROADCAST_DRIVER=.*$,BROADCAST_DRIVER=${BROADCAST_DRIVER},g" .env
[[ -v CACHE_DRIVER ]] && sed -i "s,CACHE_DRIVER=.*$,CACHE_DRIVER=${CACHE_DRIVER},g" .env
[[ -v QUEUE_CONNECTION ]] && sed -i "s,QUEUE_CONNECTION=.*$,QUEUE_CONNECTION=${QUEUE_CONNECTION},g" .env
[[ -v SESSION_DRIVER ]] && sed -i "s,SESSION_DRIVER=.*$,SESSION_DRIVER=${SESSION_DRIVER},g" .env
[[ -v SESSION_LIFETIME ]] && sed -i "s,SESSION_LIFETIME=.*$,SESSION_LIFETIME=${SESSION_LIFETIME},g" .env

[[ -v MEMCACHED_HOST ]] && sed -i "s,MEMCACHED_HOST=.*$,MEMCACHED_HOST=${MEMCACHED_HOST},g" .env

[[ -v FILESYSTEM_DISK ]] && sed -i "s,FILESYSTEM_DISK=.*$,FILESYSTEM_DISK=${FILESYSTEM_DISK},g" .env

[[ -v REDIS_HOST ]] && sed -i "s,REDIS_HOST=.*$,REDIS_HOST=${REDIS_HOST},g" .env
[[ -v REDIS_PASSWORD ]] && sed -i "s,REDIS_PASSWORD=.*$,REDIS_PASSWORD=${REDIS_PASSWORD},g" .env
[[ -v REDIS_PORT ]] && sed -i "s,REDIS_PORT=.*$,REDIS_PORT=${REDIS_PORT},g" .env

[[ -v MAIL_MAILER ]] && sed -i "s,MAIL_MAILER=.*$,MAIL_MAILER=${MAIL_MAILER},g" .env
[[ -v MAIL_HOST ]] && sed -i "s,MAIL_HOST=.*$,MAIL_HOST=${MAIL_HOST},g" .env
[[ -v MAIL_PORT ]] && sed -i "s,MAIL_PORT=.*$,MAIL_PORT=${MAIL_PORT},g" .env
[[ -v MAIL_USERNAME ]] && sed -i "s,MAIL_USERNAME=.*$,MAIL_USERNAME=${MAIL_USERNAME},g" .env
[[ -v MAIL_PASSWORD ]] && sed -i "s,MAIL_PASSWORD=.*$,MAIL_PASSWORD=${MAIL_PASSWORD},g" .env
[[ -v MAIL_ENCRYPTION ]] && sed -i "s,MAIL_ENCRYPTION=.*$,MAIL_ENCRYPTION=${MAIL_ENCRYPTION},g" .env
[[ -v MAIL_FROM_ADDRESS ]] && sed -i "s,MAIL_FROM_ADDRESS=.*$,MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS},g" .env
[[ -v MAIL_FROM_NAME ]] && sed -i "s,MAIL_FROM_NAME=.*$,MAIL_FROM_NAME=${MAIL_FROM_NAME},g" .env

[[ -v AWS_ACCESS_KEY_ID ]] && sed -i "s,AWS_ACCESS_KEY_ID=.*$,AWS_ACCESS_KEY_ID=${AWS_ACCESS_KEY_ID},g" .env
[[ -v AWS_SECRET_ACCESS_KEY ]] && sed -i "s,AWS_SECRET_ACCESS_KEY=.*$,AWS_SECRET_ACCESS_KEY=${AWS_SECRET_ACCESS_KEY},g" .env
[[ -v AWS_DEFAULT_REGION ]] && sed -i "s,AWS_DEFAULT_REGION=.*$,AWS_DEFAULT_REGION=${AWS_DEFAULT_REGION},g" .env
[[ -v AWS_BUCKET ]] && sed -i "s,AWS_BUCKET=.*$,AWS_BUCKET=${AWS_BUCKET},g" .env

[[ -v PUSHER_APP_ID ]] && sed -i "s,PUSHER_APP_ID=.*$,PUSHER_APP_ID=${PUSHER_APP_ID},g" .env
[[ -v PUSHER_APP_KEY ]] && sed -i "s,PUSHER_APP_KEY=.*$,PUSHER_APP_KEY=${PUSHER_APP_KEY},g" .env
[[ -v PUSHER_APP_SECRET ]] && sed -i "s,PUSHER_APP_SECRET=.*$,PUSHER_APP_SECRET=${PUSHER_APP_SECRET},g" .env
[[ -v PUSHER_APP_CLUSTER ]] && sed -i "s,PUSHER_APP_CLUSTER=.*$,PUSHER_APP_CLUSTER=${PUSHER_APP_CLUSTER},g" .env

[[ -v MIX_PUSHER_APP_KEY ]] && sed -i "s,MIX_PUSHER_APP_KEY=.*$,MIX_PUSHER_APP_KEY=${MIX_PUSHER_APP_KEY},g" .env
[[ -v MIX_PUSHER_APP_CLUSTER ]] && sed -i "s,MIX_PUSHER_APP_CLUSTER=.*$,MIX_PUSHER_APP_CLUSTER=${MIX_PUSHER_APP_CLUSTER},g" .env

[[ -v TELESCOPE_ENABLED ]] && sed -i "s,TELESCOPE_ENABLED=.*$,TELESCOPE_ENABLED=${TELESCOPE_ENABLED},g" .env

echo "[ DONE ]"
echo

if [[ -v DEPLOY_ON_START && "$DEPLOY_ON_START" == "true" ]]; then

    echo "# DEPLOY_ON_START mode is ON"
    echo "# Starting the deployment..."
    echo

    echo
    echo "# Put API in maintenance mode"
    php artisan down
    echo

    echo "# Link storage"
    php artisan storage:link
    echo

    echo "# Run database migrations"
    php artisan migrate --force
    echo

    echo "# Clear application cache"
    php artisan cache:clear
    php artisan config:clear
    php artisan clear-compiled
    echo

    echo "# Clear cache routes"
    php artisan route:clear
    echo

    echo "# Optimize application performance by caching configuration, events, routes, and views."
    php artisan config:cache
    php artisan event:cache
    php artisan route:cache
    php artisan view:cache
    echo

    echo "# Build css and js files"
    npm run build
    echo

    echo "# Generate sitemap"
    php artisan sitemap:create
    echo

    echo "# Put API in live mode"
    php artisan up
    echo
    echo "[ DONE ]"
fi

exec "$@"
