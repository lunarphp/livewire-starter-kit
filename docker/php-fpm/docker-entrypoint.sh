#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'artisan' ]; then

	echo "Launch project Lunar!"

	until nc -z -v -w30 mysql 3306
	do
	  echo "Waiting for database connection..."
	  # wait for 5 seconds before check again
	  sleep 5
	done

    if [ -d "config/lunar" ]; then
         echo "Lunar already install..."
         composer update
         php artisan filament:assets
    else
        echo "Starting installation..."
        composer install
        php artisan migrate
        php artisan lunar:create-admin --firstname=${ADMIN_FIRSTNAME} --lastname=${ADMIN_LASTNAME} --email=${ADMIN_EMAIL} --password=${ADMIN_PASSWORD}
        php artisan lunar:install -n
        # TODO
        #php artisan db:seed
        php artisan storage:link
        php artisan filament:assets
        php artisan storage:link
        php artisan lunar:search:index
	fi
fi

exec docker-php-entrypoint "$@"
