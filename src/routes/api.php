<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Product\ProductController;
use App\Http\Controllers\V1\Product\ShippingPriceController;
use App\Http\Controllers\V1\Product\CartController;
use App\Http\Controllers\V1\Product\CheckoutController;

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'show']);
Route::resource('product', ProductController::class)->except(['store', 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('product', ProductController::class)->only(['store', 'destroy']);
    Route::post('shipping_price', [ShippingPriceController::class, 'store']);
    Route::resource('cart', CartController::class);
    Route::post('checkout', [CheckoutController::class, 'store']);
});
