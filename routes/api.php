<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;


Route::middleware(['auth:admin'])->group(function () {

});

Route::apiResource('/category', CategoryController::class);
Route::apiResource('/type', TypeController::class);
Route::apiResource('/menu', MenuController::class);
Route::apiResource('/stok', StokController::class);
Route::apiResource('/user', UserController::class);
Route::post('/login', [AdminAuthController::class, 'login']);
    