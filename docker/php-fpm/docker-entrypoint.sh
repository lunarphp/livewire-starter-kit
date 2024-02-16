#!/bin/sh
set -e

CYAN='\x1b[36m'
MAGENTA='\x1b[35m'

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
        echo -e "$CYAN Lunar already install 🚀"
        echo -e "$MAGENTA Update dependencies..."

        composer update -n --quiet
        php artisan filament:assets --quiet > /dev/null

        echo -e "$CYAN Would you like to show some love by giving us a star ⭐ on GitHub?"
        echo -e "$CYAN Visit : https://github.com/lunarphp/lunar"
        echo -e "Your project is live ! Storefront available here: http://localhost"
    else
        echo "$BLUE Starting installation..."
        composer install
        php artisan migrate
        php artisan lunar:create-admin --firstname=${ADMIN_FIRSTNAME} --lastname=${ADMIN_LASTNAME} --email=${ADMIN_EMAIL} --password=${ADMIN_PASSWORD}
        php artisan lunar:install -n
        php artisan db:seed
        php artisan storage:link
        php artisan lunar:search:index
	fi
fi

exec docker-php-entrypoint "$@"
