<?php

use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');
// Tambahkan rute ini untuk menangani URL /products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{slug}', [ProductController::class, 'byCategory'])->name('products.byCategory');
