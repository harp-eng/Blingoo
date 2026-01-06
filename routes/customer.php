<?php

use App\Http\Controllers\API\Customer\V1\BannerController;
use App\Http\Controllers\API\Customer\V1\CategoryController;
use App\Http\Controllers\API\Customer\V1\UserController;
use Illuminate\Support\Facades\Route;



// Customer API routes
Route::group(['prefix' => 'customer'], function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [UserController::class, 'logout']);
    });

    Route::get('banners', [BannerController::class, 'index']);
    Route::get('categories', [CategoryController::class, 'index']);
});
