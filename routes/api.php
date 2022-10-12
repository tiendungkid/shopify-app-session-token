<?php

use App\Http\Controllers\Auth\AppController;
use \Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->middleware('shopify.auth')
    ->group(function () {
        Route::post('login', [AppController::class, 'login']);
    });
