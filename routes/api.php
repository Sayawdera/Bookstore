<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EmailVerificationCodeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FounderController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRelaiseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\TarifeController;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreEmailVerificationCodeRequest;
use Illuminate\Support\Facades\Route;


Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/check-user-token', [AuthController::class, 'checkUserToken']);
Route::post('/update-your-self', [AuthController::class, 'updateYourSelf']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('email-verification', [EmailVerificationCodeController::class, 'sendEmailVerification']);
Route::post('check-email-verification', [EmailVerificationCodeController::class, 'checkEmailVerification']);


Route::get('/email/verify/{id}/{hash}', function (StoreEmailVerificationCodeRequest $request) {
    $request->fulfill();

    return redirect('home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::middleware(['auth:sanctum'])->prefix('/admin')->group( function (){

    Route::apiResource('/user', UserController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/brands', BrandController::class);
    Route::apiResource('/role', RoleController::class);
    Route::apiResource('/payment', PaymentController::class);
    Route::apiResource('/countries', CountryController::class);
    Route::apiResource('/product-relaises', ProductRelaiseController::class);
    Route::apiResource('/tarifes', TarifeController::class);
    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/faqs', FaqController::class);
    Route::apiResource('/founders', FounderController::class);
    Route::apiResource('/genres', GenreController::class);
    Route::apiResource('/status', StatusController::class);

});




Route::get('token-status', function ()
{
     return "not authorized"; 
})->name('token-status');