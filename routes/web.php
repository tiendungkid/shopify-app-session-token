<?php

use App\Http\Controllers\Auth\ShopifyAuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [ShopifyAuthController::class, 'login'])->name('login');
Route::get('login/toplevel', [ShopifyAuthController::class, 'loginToplevel'])->name('login.toplevel');
Route::get('auth/callback', [ShopifyAuthController::class, 'authCallback']);

Route::fallback([ShopifyAuthController::class, 'fallbackRoute']);

Route::get('dashboard', [ShopifyAuthController::class, 'dashboard']);
