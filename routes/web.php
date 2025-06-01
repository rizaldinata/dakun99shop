<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
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
    Route::resource('admin/products', ProductController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProductUserController::class, 'index'])->name('produk.index');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');

    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');

    // Checkout
    Route::post('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

require __DIR__.'/auth.php';