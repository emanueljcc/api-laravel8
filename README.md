## API Hotels

Important: (PHP 7.3)
This is a sample project for the API Hotels using Laravel 8 and MySQL how database and other tools.

Developer Branchs:
`master`
`staging`
`develop`

## Running the API in localhost

It is very easy to get the API up and running to deploy on localhost.
First you have to edit the project's .env, if you don't have it create a .env file following the example of .env.example that already has the environment variables declared.

Inside the root of the project execute the following command:
cp .env.example .env

Be sure to edit the values ​​of the database environment variables.

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_password
```

Then install, migrate, seed, all that jazz:

1. `composer install`
2. `npm install`
3. `php artisan migrate`
4. `php artisan passport:install`
5. `php artisan db:seed`
6. `php artisan serve`

**The API will be running on `localhost:8000`.**

To generate the API documentation through Swagger use the following command:

`php artisan l5-swagger:generate`

## See documentation generated with Swagger

And to see the list of available endpoints, it is the following link:
http://localhost:8000/api/documentation

To understand more about the Swagger documentation in Laravel, you can view the documentation at the following link: https://github.com/DarkaOnLine/L5-Swagger

TODO: AGREGAR DOCUMENTACION EN README, LINK DE LA COLLECTION, IMAGENES DE LA COLLECTION, EJEMPLOS DE RESPUESTA DE LA API...
