<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTransactionController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::resource('admin/products', AdminProductController::class);
    Route::get('admin/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions.index');
    Route::patch('admin/transactions/{transaction}', [AdminTransactionController::class, 'update'])->name('admin.transactions.update');
    Route::get('/admin/transaksi/{transaction}', [AdminTransactionController::class, 'show'])->name('admin.transactions.show');
});

Route::middleware(['auth'])->group(function () {

    // Produk
    Route::get('/produk', [ProductUserController::class, 'index'])->name('produk.index');
    Route::get('/produk/{product}', [ProductUserController::class, 'show'])->name('produk.show');

    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');

    // Checkout
    Route::post('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Riwayat Transaksi
    Route::get('/transaksi-saya', [UserTransactionController::class, 'index'])->name('user.transactions.index');

    // Detail Transaksi
    Route::get('/transaksi-saya/{transaction}', [UserTransactionController::class, 'show'])->name('user.transactions.show');
});

require __DIR__.'/auth.php';