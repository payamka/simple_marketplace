<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\RegisterController;

Route::post('register', [RegisterController::class, 'store']);
