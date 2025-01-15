<p align="center"><a href="https://lunarphp.io/" target="_blank"><img src="https://raw.githubusercontent.com/lunarphp/art/main/lunar-logo.svg" width="200" alt="Lunar"></a></p>

# Starter Kit

This repository is provided as a reference to learn how to use Lunar Laravel E-Commerce package. This example is a classic e-commerce store.

> **Warning**
> This application is purely an example of how you can implement Lunar headless e-commerce for Laravel. It is not production ready or complete.

# Installation

For full installation instructions please visit https://docs.lunarphp.io/core/starter-kits.html

## Installation with Docker

> Make sure you have Docker installed on your local machine.

### Environment Demo store

You can execute it via the `docker compose up` command in your favorite terminal. 
Please note that the speed of building images and initializing containers depends on your local machine and internet connection - it may take some time. 

```bash
cp .env.docker.example .env
docker-compose up
```

The demo store will be available to `http://localhost` in your browser.

### Searching

Out the box, the starter kit is configured to use Meilisearch. You will need to ensure you have this set up, you should also check the following config files to familiarise yourself how search is configured to work.

- `config/lunar/search.php`
- `config/scout.php`

To customise what is indexed, you should look at the `Search/ProductIndexer` class.

####  Log into Lunar panel

Once the project is prepared, the Lunar panel will start and available to `http://localhost/lunar`. 

Default admin user is username `admin@lunarphp.io` and password `password`
