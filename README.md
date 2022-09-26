<p align="center"><a href="https://lunarphp.io/" target="_blank"><img src="https://raw.githubusercontent.com/lunarphp/art/main/lunar-logo.svg" width="200" alt="Lunar"></a></p>

# Demo Store

This repository is provided as a reference to learn how to use Lunar Laravel E-Commerce package. This example is a classic e-commerce store.

> **Warning**
> This application is purely an example of how you can implement Lunar headless e-commerce for Laravel. It is not production ready or complete.

# Requirements

This demo store uses MySQL as the Scout driver. This is not the recommended approach for a production environment, but it works well for development.

# Installation

## Clone the repo

```bash
git clone --depth=1 https://github.com/lunarphp/demo-store.git
```

This will create a shallow clone of the repo, from there you would just need to remove the `.git` folder and reinitialise it to make it your own.

Then install composer dependencies

```bash
composer install
```

## Configure the Laravel app

Copy the `.env.example` file to `.env` and make sure the details match to your install.

```shell
cp .env.example .env
```

All the relevant configuration files should be present in the repo.

## Migrate and seed.

Run the migrations

```
php artisan migrate
```

Install Lunar

```
php artisan lunar:install
```

Seed the demo data.

```
php artisan db:seed
```

Link the storage directory

```
php artisan storage:link
```

---

This demo store uses Livewire to handle all routing and Laravel components where they make sense.
