## TOOLS
 - node - version 20.19 and above
 - composer

## Server Dependencies
 - PHP >= 8.2
 - Ctype PHP Extension
 - cURL PHP Extension
 - DOM PHP Extension
 - Fileinfo PHP Extension
 - Filter PHP Extension
 - Hash PHP Extension
 - Mbstring PHP Extension
 - OpenSSL PHP Extension
 - PCRE PHP Extension
 - PDO PHP Extension
 - Session PHP Extension
 - Tokenizer PHP Extension
 - XML PHP Extension


## Run Application
 - cd to the project repo
 - instsall node packages and build assets by running `npm install && npm run build`
 - install laravel app packages and dependencies by running `composer install`
 - create .env file and copy the .env.example
 - generate app key by running `php artisan key:generate`
 - setup your db credentials. Preferred to use MySql
 - run `php artisan migrate` to migrate tables;
 - run `php artisan db:seed` to dump sample user. This will generate a sample user and credentials will be pre-filled in sample UI.
 - run `php artisan serve` and application will be accessible to this [http://127.0.0.1:8000](http://127.0.0.1:8000).


## Testing

 - run `php artisan test`
