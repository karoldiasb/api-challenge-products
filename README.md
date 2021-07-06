# api-challenge-products

## REST API with endpoints:
```    
`GET /`: return status 200 and a message "PHP Challenge 20201117"

`POST /products`: process file .json (products.json)

`PUT /products/:productId`: update product

`DELETE /products/:productId`: remove product

`GET /products/:productId`: get a product

`GET /products`: get all products
```

## Project setup
```
composer install
```

## Gererate APP_KEY 
```
php artisan key:generate
```

## Copy file ".env.example", paste and rename ".env"

## In file ".env", change database connection, example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=products
DB_USERNAME=root
DB_PASSWORD=
```

## Then run 
```
php artisan migrate
```

### Compiles and hot-reloads for development
```
php artisan serve
```