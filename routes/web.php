<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Transaksi_PenjualanController;

// === Redirect root ke halaman login ===
Route::get('/', function () {
    return redirect()->route('login');
});

// === ROUTE AUTHENTICATION ===
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// === ROUTE YANG DILINDUNGI LOGIN (AUTH MIDDLEWARE) ===
Route::middleware(['auth'])->group(function () {

    // Dashboard hanya bisa diakses kalau sudah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('/products', ProductController::class);

    // Supplier
    Route::resource('/supplier', SupplierController::class);

    // Transaksi Penjualan
    Route::resource('/transaksi_penjualan', Transaksi_PenjualanController::class);

    // Email
    Route::get('/send-email/{to}/{Id}', [Transaksi_PenjualanController::class, 'sendEmail']);
});
