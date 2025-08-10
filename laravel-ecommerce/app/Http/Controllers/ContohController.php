<?php

namespace App\Http\Controllers;
use illuminate\Http\Request;

class ContohController extends Controller
{
    

   public function tambah($a, $b)
   {
       return $a + $b;
   }

   public function halaman ()
      {
       $title = "Halaman Index";
        $sub_title = "Sub Halaman Index";
        $products = [
            ['id' => 1, 
            'name' => 
            'Produk A', 
            'price' => 10000
        ],
            ['id' => 2, 
            'name' => 'Produk B', 
            'price' => 15000
        ],
            ['id' => 3, 
            'name' => 'Produk C', 
            'price' => 20000
        ],
    ];

        return view('product.index', compact('title', 'sub_title', 'products'));
      }

}