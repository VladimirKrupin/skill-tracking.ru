$ composer install
$ npm i
$ cp .env.example .env
$ sudo chmod -R 777 storage/
$ php artisan migrate
$ php artisan passport:install
$ sudo chown www-data:www-data storage/oauth-*.key
$ sudo chmod 600 storage/oauth-*.key
$ php artisan cache:clear
$ php artisan key:generate
    result command: Application key [key] set successfully.
    in .env APP_KEY=key
