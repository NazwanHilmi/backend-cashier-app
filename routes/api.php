<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;

Route::middleware(['cors', 'json.response'])->group(function () {

	Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::apiResource('users', UserController::class);

    Route::apiResource('/category', CategoryController::class);
	Route::apiResource('roles', RoleController::class);
    Route::apiResource('/type', TypeController::class);
    Route::apiResource('/menu', MenuController::class);
    Route::apiResource('/stok', StokController::class);
    Route::apiResource('/customer', CustomerController::class);
    Route::apiResource('/meja', MejaController::class);
    Route::apiResource('/user', UserController::class);
    Route::apiResource('/karyawan', KaryawanController::class);

    Route::apiResource('/payment_methods', PaymentMethodController::class);
    Route::apiResource('/transaksi', TransaksiController::class);
    Route::apiResource('/detail-transaksi', DetailTransaksiController::class);

});

Route::apiResource('/product', ProductController::class);
Route::get('export-pdf', [ProductController::class, 'exportPdf']);
Route::post('import-excel', [ProductController::class, 'importExcel']);


// Route::post('/login', [AuthController::class, 'login']);
