# INSTALLATION GUIDE

```sh
cp .env.example .env
```

> create DB and change DB variables to match your local settings (inside .env file)

Then run this commands to create tables
```sh
php artisan migrate
```


For test environment run below commands

```sh
cp .env.example .env.testing
```

create DB for unit test and change DB variables to match your local settings (.env.testing file)

Run following commands

```sh
php artisan key:generate
```

```sh
composer install
```

```sh
npm install
```

```sh
npm run dev
```

For starting project run
```sh
php artisan serve
```

For retrieving data from rapid API we have schedule command, which works every minute
But for manually retrieving data we can run following command

```sh
php artisan stock:fetch
```

For running unit test run

```sh 
php artisan test
```
