# BuckHill Ecommerce

BuckHill Ecommerce is a minimal application for executing minimal ecommerce tasks.

## Installation

Use git to clone and initialize BuckHill.

```bash
git clone https://github.com/oghenemavo/buckhill-ecommerce.git
```

## Usage

```composer
composer install

# generate application key
php artisan key:generate

# generate jwt secret key
php artisan jwt:secret

* Create a database and setup your .env file

```
## Procedures
```php

# seed application
php artisan db:seed

*PLEASE CREATE PRODUCTS BEFORE USING THIS ORDER SEEDER*
php artisan db:seed --class=CustomerOrderSeeder 

```
> swagger collection can be found at http://127.0.0.1:8000/swagger/docs
> postman collection was generated and stored as collection.postman_collection.json

## Libraries List
* [PHP-Open-Source-Saver](https://github.com/PHP-Open-Source-Saver/jwt-auth)
* [PHPInsights](https://phpinsights.com/)
* [PHPStan](https://phpstan.org/)
* [PHP Pest](https://pestphp.com/)
* PHP Pint
