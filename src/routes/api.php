<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\Auth\LoginController;

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'show']);
