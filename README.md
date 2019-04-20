# LaravelFirstProject

## Installation

Install dependencies.

```sh
composer install
```

Make a `.env` file.

```sh
cp .env.example .env
```

Key generate
```sh
php artisan key:generate
```

Update variables in .env file

```
DB_DATABASE=<name of database>
DB_USERNAME=<mysql username>
DB_PASSWORD=<mysql password>
```

Finally run this to generate fake data
```
php artisan migrate:fresh --seed
```

To start server run
```
php artisan serve
```
