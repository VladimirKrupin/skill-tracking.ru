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

start instruction

    put .env file
    docker exec -it agatefundru_docker_composer_1 composer install
    mysql -ufg -p
    create database agatefund;exit;
    php artisan migrate
    php artisan passport:install
    
    
    sudo chmod 777 -R storage/ && sudo chmod 777 -R bootstrap/cache/ && chown www-data:www-data storage/oauth-*.key && chmod 600 storage/oauth-*.key && php artisan cache:clear
    
selects

    select * from users;select * from posts;select * from files;