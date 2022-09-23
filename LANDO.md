# Lando Development Environment

Ensure you have Lando installed first https://lando.dev/

```sh
lando start
````

Then set-up Lunar...

```sh
lando composer install
cp .env.lando.example .env
lando artisan migrate
lando artisan lunar:install
lando artisan db:seed
lando artisan storage:link
````
