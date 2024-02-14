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

	if [ "$INIT_INSTALL" == '1' ]; then
		composer install
		php artisan migrate
        php artisan lunar:install
        # TODO : clean seeder
        #php artisan db:seed
        php artisan storage:link
		php artisan filament:assets
		php artisan storage:link
	fi
fi

exec docker-php-entrypoint "$@"
