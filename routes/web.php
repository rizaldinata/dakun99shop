<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminTransactionController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('admin/products', AdminProductController::class);
    Route::get('admin/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions.index');
    Route::patch('admin/transactions/{transaction}', [AdminTransactionController::class, 'update'])->name('admin.transactions.update');
    Route::get('/admin/transaksi/{transaction}', [AdminTransactionController::class, 'show'])->name('admin.transactions.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProductUserController::class, 'index'])->name('produk.index');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');

    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');

    // Checkout
    Route::post('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Riwayat Transaksi
    Route::get('/transaksi-saya', [UserTransactionController::class, 'index'])->name('user.transactions.index');

    // Detail Transaksi
    Route::get('/transaksi-saya/{transaction}', [UserTransactionController::class, 'show'])
        ->name('user.transactions.show');
});

require __DIR__.'/auth.php';