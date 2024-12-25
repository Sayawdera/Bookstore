<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


##  Rest API for BookStore in Laravel V: 11



## Git Clone

```php
 git clone https://github.com/AIAnsar1/Bookstore.git
```

## Key Generate 

```php
 php artisan key:generate
```

## Optimize All Cache Application 

```php
 php artisan optimize:clear
```


## Create .ENV 

<h4>Windows:</h4>

```php
 copy .env.example .env
```

<h4>Linux/Mac:</h4>

```php
 cp .env.example .env
```

## Run Migrate Default: (PostgreSQL)

```php
 php artisan migrate
```

## Run With Docker: (Sail) Default Redis/PostgreSQL

<h4>Runn Docker:</h4>

```php
    php artisan sail:install / sail:add + add redis & postgresql
```
<h4>Run:</h4>

```php
    ./vendor/bin/sail up && ./vendor/bin/sail artisan migrate
```

## This Project also Only Rest API with Repository & Service Patterns
<h4>Address for Browser or Postman Testing With Docs:</h4>

```php
 http://127.0.0.1:8000/docs/api.json
```

```php
 http://127.0.0.1:8000/docs/api/
```

## All Routes

<h4>Route:list:</h4>

```php
 GET|HEAD        api/admin/authors ................................................. authors.index › AuthorController@index
  POST            api/admin/authors ................................................. authors.store › AuthorController@store
  GET|HEAD        api/admin/authors/{author} .......................................... authors.show › AuthorController@show
  PUT|PATCH       api/admin/authors/{author} ...................................... authors.update › AuthorController@update
  DELETE          api/admin/authors/{author} .................................... authors.destroy › AuthorController@destroy
  GET|HEAD        api/admin/brands .................................................... brands.index › BrandController@index
  POST            api/admin/brands .................................................... brands.store › BrandController@store
  GET|HEAD        api/admin/brands/{brand} .............................................. brands.show › BrandController@show
  PUT|PATCH       api/admin/brands/{brand} .......................................... brands.update › BrandController@update
  DELETE          api/admin/brands/{brand} ........................................ brands.destroy › BrandController@destroy
  GET|HEAD        api/admin/categories ......................................... categories.index › CategoryController@index
  POST            api/admin/categories ......................................... categories.store › CategoryController@store
  GET|HEAD        api/admin/categories/{category} ................................ categories.show › CategoryController@show
  PUT|PATCH       api/admin/categories/{category} ............................ categories.update › CategoryController@update
  DELETE          api/admin/categories/{category} .......................... categories.destroy › CategoryController@destroy
  GET|HEAD        api/admin/countries ............................................ countries.index › CountryController@index
  POST            api/admin/countries ............................................ countries.store › CountryController@store
  GET|HEAD        api/admin/countries/{country} .................................... countries.show › CountryController@show
  PUT|PATCH       api/admin/countries/{country} ................................ countries.update › CountryController@update
  DELETE          api/admin/countries/{country} .............................. countries.destroy › CountryController@destroy
  GET|HEAD        api/admin/faqs .......................................................... faqs.index › FaqController@index
  POST            api/admin/faqs .......................................................... faqs.store › FaqController@store
  GET|HEAD        api/admin/faqs/{faq} ...................................................... faqs.show › FaqController@show
  PUT|PATCH       api/admin/faqs/{faq} .................................................. faqs.update › FaqController@update
  DELETE          api/admin/faqs/{faq} ................................................ faqs.destroy › FaqController@destroy
  GET|HEAD        api/admin/founders .............................................. founders.index › FounderController@index
  POST            api/admin/founders .............................................. founders.store › FounderController@store
  GET|HEAD        api/admin/founders/{founder} ...................................... founders.show › FounderController@show
  PUT|PATCH       api/admin/founders/{founder} .................................. founders.update › FounderController@update
  DELETE          api/admin/founders/{founder} ................................ founders.destroy › FounderController@destroy
  GET|HEAD        api/admin/genres .................................................... genres.index › GenreController@index
  POST            api/admin/genres .................................................... genres.store › GenreController@store
  GET|HEAD        api/admin/genres/{genre} .............................................. genres.show › GenreController@show
  PUT|PATCH       api/admin/genres/{genre} .......................................... genres.update › GenreController@update
  DELETE          api/admin/genres/{genre} ........................................ genres.destroy › GenreController@destroy
  GET|HEAD        api/admin/payment ................................................ payment.index › PaymentController@index
  POST            api/admin/payment ................................................ payment.store › PaymentController@store
  GET|HEAD        api/admin/payment/{payment} ........................................ payment.show › PaymentController@show
  PUT|PATCH       api/admin/payment/{payment} .................................... payment.update › PaymentController@update
  DELETE          api/admin/payment/{payment} .................................. payment.destroy › PaymentController@destroy
  GET|HEAD        api/admin/product-relaises ....................... product-relaises.index › ProductRelaiseController@index
  POST            api/admin/product-relaises ....................... product-relaises.store › ProductRelaiseController@store
  GET|HEAD        api/admin/product-relaises/{product_relaise} ....... product-relaises.show › ProductRelaiseController@show
  PUT|PATCH       api/admin/product-relaises/{product_relaise} ... product-relaises.update › ProductRelaiseController@update
  DELETE          api/admin/product-relaises/{product_relaise} . product-relaises.destroy › ProductRelaiseController@destroy
  GET|HEAD        api/admin/products .............................................. products.index › ProductController@index
  POST            api/admin/products .............................................. products.store › ProductController@store
  GET|HEAD        api/admin/products/{product} ...................................... products.show › ProductController@show
  PUT|PATCH       api/admin/products/{product} .................................. products.update › ProductController@update
  DELETE          api/admin/products/{product} ................................ products.destroy › ProductController@destroy
  GET|HEAD        api/admin/role ......................................................... role.index › RoleController@index
  POST            api/admin/role ......................................................... role.store › RoleController@store
  GET|HEAD        api/admin/role/{role} .................................................... role.show › RoleController@show
  PUT|PATCH       api/admin/role/{role} ................................................ role.update › RoleController@update
  DELETE          api/admin/role/{role} .............................................. role.destroy › RoleController@destroy
  GET|HEAD        api/admin/status ................................................... status.index › statusController@index
  POST            api/admin/status ................................................... status.store › statusController@store
  GET|HEAD        api/admin/status/{status} ............................................ status.show › statusController@show
  PUT|PATCH       api/admin/status/{status} ........................................ status.update › statusController@update
  DELETE          api/admin/status/{status} ...................................... status.destroy › statusController@destroy
  GET|HEAD        api/admin/tarifes ................................................. tarifes.index › TarifeController@index
  POST            api/admin/tarifes ................................................. tarifes.store › TarifeController@store
  GET|HEAD        api/admin/tarifes/{tarife} .......................................... tarifes.show › TarifeController@show
  PUT|PATCH       api/admin/tarifes/{tarife} ...................................... tarifes.update › TarifeController@update
  DELETE          api/admin/tarifes/{tarife} .................................... tarifes.destroy › TarifeController@destroy
  GET|HEAD        api/admin/user ......................................................... user.index › UserController@index
  POST            api/admin/user ......................................................... user.store › UserController@store
  GET|HEAD        api/admin/user/{user} .................................................... user.show › UserController@show
  PUT|PATCH       api/admin/user/{user} ................................................ user.update › UserController@update
  DELETE          api/admin/user/{user} .............................................. user.destroy › UserController@destroy
  POST            api/check-email-verification ...................... EmailVerificationCodeController@checkEmailVerification
  POST            api/check-user-token .................................................. Auth\AuthController@checkUserToken
  POST            api/email-verification ............................. EmailVerificationCodeController@sendEmailVerification
  GET|HEAD        api/email/verify/{id}/{hash} ......................................................... verification.verify
  POST            api/login .............................................................. login › Auth\AuthController@login
  POST            api/logout .................................................................... Auth\AuthController@logout
  POST            api/register ................................................................ Auth\AuthController@register
  POST            api/reset-password ..................................................... Auth\AuthController@resetPassword
  GET|HEAD        api/token-status ............................................................................ token-status
  POST            api/update-your-self .................................................. Auth\AuthController@updateYourself
```
