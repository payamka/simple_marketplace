# Simple Marketplace

A simple marketplace project based on Laravel 10

## Installation

Before installation please install and run Docker and Docker Compose. Then clone the project into any directory you want.

Then in the root folder of the project run the below commands:

- Run docker container:
```bash
docker compose up -d
```

- Create database:

Now you can access phpMyAdmin from `http:localhost:8085` username: `root` and no password. create a database named `marketplace`.

- Install composer dependencies:
```bash
docker compose run --rm composer install
```

- Run project installation script:
```bash
docker compose run --rm artisan app:init
```
The above command will generate a `.env` file, generate `App Secret Key` and run migrations.

Now endpoints are available from `http:localhost`.

- Run Unit Test
```bash
docker compose run --rm artisan test
```
