<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// User registration 
Route::post('/v1/register', [UserController::class, 'register'])->middleware('check.email');

// User login routes
Route::post('/v1/login', [UserController::class, 'login']);

// User Logout
Route::post('/v1/logout', [UserController::class, 'logout']);
