<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminAuthController;


Route::middleware(['auth:admin'])->group(function () {
    Route::apiResource('/menu', MenuController::class);
});

Route::apiResource('/category', CategoryController::class);
Route::apiResource('/user', UserController::class);
Route::post('/login', [AdminAuthController::class, 'login']);
    