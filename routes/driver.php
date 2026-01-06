<?php

use App\Http\Controllers\API\Driver\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driver'], function () {
    Route::post('login', [UserController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});
