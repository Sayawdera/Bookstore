<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FounderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRelaiseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TarifeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::apiResource('/countries', CountryController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/products', ProductController::class);
Route::apiResource('/brands', BrandController::class);
Route::apiResource('/role', RoleController::class);
Route::apiResource('/payment', PaymentController::class);
Route::apiResource('/user', UserController::class);
Route::apiResource('/product-relaises', ProductRelaiseController::class);
Route::apiResource('/tarifes', TarifeController::class);
Route::apiResource('/authors', AuthorController::class);
Route::apiResource('/faqs', FaqController::class);
Route::apiResource('/founders', FounderController::class);


Route::get('token-status', function ()
{
     return "not authorized"; 
})->name('token-status');