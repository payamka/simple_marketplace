<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Product\ProductController;

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'show']);
Route::resource('product', ProductController::class)->except(['destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('product', ProductController::class)->only(['destroy']);
});
