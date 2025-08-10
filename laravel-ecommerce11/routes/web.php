<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\HomeController;


Route::get('/index/{a}/{b}', [ContohController::class, 'tambah']);
Route::get('/product', [ContohController::class, 'Halaman']);

Route::get('/', [HomeController::class, 'index']);
    



