<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);