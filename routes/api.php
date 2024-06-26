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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ExportNotaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DataController;

Route::middleware(['cors', 'json.response'])->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::apiResource('users', UserController::class);

    
});

Route::apiResource('/category', CategoryController::class);
Route::get('/category-pdf', [CategoryController::class, 'exportPdf']);
Route::get('/category-excel', [CategoryController::class, 'exportExcel']);
Route::post('/category/import-excel', [CategoryController::class, 'importExcel']);

Route::apiResource('roles', RoleController::class);

Route::apiResource('/type', TypeController::class);
Route::get('/type-pdf', [TypeController::class, 'exportPdf']);
Route::get('/type-excel', [TypeController::class, 'exportExcel']);
Route::post('/type/import-excel', [TypeController::class, 'importExcel']);

Route::apiResource('/menu', MenuController::class);
Route::get('/menu-pdf', [MenuController::class, 'exportPdf']);
Route::get('/menu-excel', [MenuController::class, 'exportExcel']);
Route::post('/menu/import-excel', [MenuController::class, 'importExcel']);

Route::apiResource('/stok', StokController::class);
Route::get('/stok-pdf', [StokController::class, 'exportPdf']);
Route::get('/stok-excel', [StokController::class, 'exportExcel']);
Route::post('/stok/import-excel', [StokController::class, 'importExcel']);

Route::apiResource('/customer', CustomerController::class);
Route::get('/customer-pdf', [CustomerController::class, 'exportPdf']);
Route::get('/customer-excel', [CustomerController::class, 'exportExcel']);
Route::post('/customer/import-excel', [CustomerController::class, 'importExcel']);

Route::apiResource('/meja', MejaController::class);
Route::apiResource('/user', UserController::class);
Route::apiResource('/karyawan', KaryawanController::class);

Route::apiResource('/payment_methods', PaymentMethodController::class);

Route::apiResource('/grafik', DataController::class);
Route::get('/grafik-income', [DataController::class, 'income']);
Route::get('/count-menu', [DataController::class, 'countMenu']);
Route::get('/grafik-total', [DataController::class, 'totalMenu']);
Route::get('/grafik-order', [DataController::class, 'mostMenu']);
Route::get('/grafik-popular', [DataController::class, 'mostPopularMenu']);
Route::get('/grafik-stok', [DataController::class, 'lowStock']);
Route::get('/grafik-chart', [DataController::class, 'dailyIncome']);
Route::post('/grafik-filter', [DataController::class, 'filterByDate']);

Route::apiResource('/transaksi', TransaksiController::class);
Route::get('/transaksi-pdf', [TransaksiController::class, 'exportPdf']);
Route::get('/transaksi-excel', [TransaksiController::class, 'exportExcel']);
Route::get('/transaksi-filter', [TransaksiController::class, 'filterDate']);

Route::get('/cetak-nota/{id}', [ExportNotaController::class, 'cetakNota']);
Route::apiResource('/detail-transaksi', DetailTransaksiController::class);

Route::apiResource('/absensi', AbsensiController::class);
Route::get('/absensi-pdf', [AbsensiController::class, 'exportPdf']);
Route::get('/absensi-excel', [AbsensiController::class, 'exportExcel']);
Route::post('/absensi/import-excel', [AbsensiController::class, 'importExcel']);
Route::get('/absensi/report', [AbsensiController::class, 'dateReport']);

Route::apiResource('/product', ProductController::class);
Route::get('export-pdf', [ProductController::class, 'exportPdf']);
Route::post('import-excel', [ProductController::class, 'importExcel']);
Route::get('export-excel', [ProductController::class, 'exportExcel']);

Route::post('send-email', [ContactController::class, 'sendEmail']);

// Route::post('/login', [AuthController::class, 'login']);
