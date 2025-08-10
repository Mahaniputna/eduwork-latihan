<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   
   
    public function index()
    {
    $judul = "Beranda";
    $title = "Selamat datang di e-commerce page";
    $sub_title = "Barang Branded";
    $products = [
        [
        'id' => 1,
        'name' => 'Produk A',
        'image' => 'image/jashujan.jpg',
        'description' => 'Produk A adalah produk berkualitas tinggi.',
        'price' => 10000
        ],

        [
        'id' => 2,
        'name' => 'Produk B',
        'image' => 'image/Laptop.jpeg',
        'description' => 'Produk B menawarkan fitur terbaik di kelasnya.',
        'price' => 15000
        ],

        [
        'id' => 3,
        'name' => 'Produk C',
        'image' => 'image/sepatu.jpg',
        'description' => 'Produk C adalah produk unggulan dengan kualitas terbaik.',
        'price' => 20000
        ],
    ];

    return view('home', compact('judul', 'title', 'sub_title', 'products'));
    }
}
