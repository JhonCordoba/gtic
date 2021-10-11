## GTIC
Sistema de Gestión de Recursos Tecnológicos

## Starting

rename ".env-example" to ".env", then run the following comands:

```bash

#install the composer depencencies

composer install

#generate the laravel key

php artisan key:generate

php artisan jwt:secret

php artisan migrate

#para solucionar el problema de “ReflectionException: Class UsersTableSeeder does not exist“ al realizar el seeder:

composer dumpautoload

php artisan db:seed

php artisan storage:link

```
