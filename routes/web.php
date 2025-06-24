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
use App\Http\Controllers\ProfileController;

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

    // Routes yang bisa diakses semua user (admin dan pegawai) - hanya view dan search
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/{obat}', [ObatController::class, 'show'])->name('obat.show');
    
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');

    Route::get('/expired', [ExpiredController::class, 'index'])->name('expired');
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Routes khusus admin (create, edit, delete)
Route::middleware(['auth', 'admin'])->group(function () {
    // Kategori Admin Routes
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    
    // Obat Admin Routes
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/{obat}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{obat}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{obat}', [ObatController::class, 'destroy'])->name('obat.destroy');
    
    // Supplier Admin Routes
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    
    // Laporan hanya untuk admin
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});
