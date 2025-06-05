<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index');

    Route::resource('kategori', KategoriController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('supplier', SupplierController::class);

    Route::get('/expired', [ExpiredController::class, 'index'])->name('expired');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
