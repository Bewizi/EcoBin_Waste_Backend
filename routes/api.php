<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserMiddleware;

// User registration 
Route::post('/v1/register', [UserController::class, 'register'])->middleware('check.email');

// User login routes
Route::post('/v1/login', [UserController::class, 'login']);
