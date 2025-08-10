<?php

// file: routes/web.php
// Tambahkan route ini untuk mengarahkan ke halaman yang sesuai.
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman detail produk
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// Halaman produk berdasarkan kategori
Route::get('/products/{category}', [HomeController::class, 'filterByCategory'])->name('products.category');

// Halaman semua produk dalam carousel
Route::get('/products/carousel', [HomeController::class, 'carousel'])->name('products.carousel');

// Halaman keranjang belanja
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');

// Tambahkan produk ke keranjang
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');

// Perbarui jumlah produk di keranjang
Route::post('/cart/update', [HomeController::class, 'updateCart'])->name('cart.update');

// Hapus produk dari keranjang
Route::post('/cart/remove', [HomeController::class, 'removeFromCart'])->name('cart.remove');
