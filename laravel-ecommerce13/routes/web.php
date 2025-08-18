<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContohController;

Route::get('/contoh', [ContohController::class, 'index']);

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function () {
    return view('product.index');
});


