<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
Route::get('/api/category-data', [BarangController::class, 'getCategoryData']);
Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('pembelian', PembelianController::class)->middleware('auth');
Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('supplier', SupplierController::class)->middleware('auth');
Route::resource('pembeli', PembeliController::class)->middleware('auth');
Route::resource('penjualan', PenjualanController::class)->middleware('auth');
Route::get('laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan-penjualan.index')->middleware('auth');
Route::get('laporan-penjualan/export-pdf', [LaporanPenjualanController::class, 'exportPdf'])->name('laporan-penjualan.export-pdf')->middleware('auth');
Route::post('/pembelian/{pembelian}/update-status', [PembelianController::class, 'updateStatus'])->name('pembelian.updateStatus');

// pdf
Route::get('/barang/export-pdf', [BarangController::class, 'exportPdf'])->name('barang.exportPdf')->middleware('auth');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
