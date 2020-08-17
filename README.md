Laravel Countries API application

## Technical requirements

- [Docker](https://www.docker.com/get-started).
- [Git](https://git-scm.com/).
- Made with [Laradock](https://laradock.io/)

## Installation

- **Init laradock submodule**

``` bash
git submodule init
```

- **Move to laradock directory, init env file and start docker**

``` bash
cd laradock && cp env-example .env && docker-compose up -d nginx mysql phpmyadmin redis workspace 
```

- **Edit the env file depends on your data, exec workspace container and init laravel application**

```bash
composer install && php artisan key:generate
```

## Available methods

- /api/users/{id}/transactions (GET) - List of all user transactions 
- /api/transactions (GET) - List sum of transaction per day
- /api/users (POST) - Create new user
- /api/transactions (POST) - Create new transaction

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).