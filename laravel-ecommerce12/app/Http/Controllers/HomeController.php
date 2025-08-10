<?php

// file: HomeController.php
// Controller ini menangani logika untuk halaman utama dan keranjang belanja.
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Daftar produk (Anda bisa menggantinya dengan data dari database)
    private $products = [
        [
            'id' => 1,
            'name' => 'Produk A',
            'category' => 'Fashion',
            'image' => 'jashujan.jpg',
            'description' => 'Produk A adalah produk berkualitas tinggi.',
            'price' => 10000
        ],
        [
            'id' => 2,
            'name' => 'Produk B',
            'category' => 'Elektronik',
            'image' => 'Laptop.jpeg',
            'description' => 'Produk B menawarkan fitur terbaik di kelasnya.',
            'price' => 15000
        ],
        [
            'id' => 3,
            'name' => 'Sepatu Sneakers Pria "Urban Flex"',
            'category' => 'Sneakers Pria',
            'image' => 'sepatu.jpg',
            'description' => 'Sepatu Sneakers Pria Urban Flex dirancang untuk Anda yang mengutamakan kenyamanan dan gaya. Terbuat dari bahan berkualitas tinggi dengan desain modern yang cocok dipadukan untuk berbagai aktivitas, mulai dari jalan santai, hangout, hingga olahraga ringan.
                Dengan teknologi breathable mesh, kaki tetap terasa sejuk sepanjang hari, dan cushion insole memberikan kenyamanan ekstra saat melangkah. Sol karet anti-slip memastikan pijakan lebih stabil di berbagai medan.',
            'price' => 399000,
            'details' => [
                'Merek' => 'Urban Flex',
                'Model' => 'Streetwear Edition 2025',
                'Warna Tersedia' => ['Hitam', 'Putih', 'Abu-abu'],
                'Ukuran' => '39 – 44 (EU Size)',
                'Spesifikasi Teknis' => [
                    'Bahan Atas (Upper)' => 'Mesh premium + sintetis',
                    'Bahan Sol' => 'Karet anti-slip',
                    'Insole' => 'Cushion Memory Foam',
                    'Berat' => '± 750 gram (per pasang)',
                    'Tinggi Sol' => '3 cm',
                    'Desain' => 'Lace-up (bertali)'
                ]
            ]
        ],
    ];

    // Tampilkan halaman utama dengan daftar produk
    public function index()
    {
        $title = "Selamat datang di e-commerce page";
        $sub_title = "Barang Branded";
        $categories = collect($this->products)->pluck('category')->unique();

        return view('home', [
            'title' => $title,
            'sub_title' => $sub_title,
            'products' => $this->products,
            'categories' => $categories
        ]);
    }

    // Filter produk berdasarkan kategori
    public function filterByCategory($category)
    {
        $filteredProducts = collect($this->products)->where('category', $category)->all();
        $categories = collect($this->products)->pluck('category')->unique();

        $title = "Produk Kategori: " . ucfirst($category);
        $sub_title = "Temukan produk terbaik dari kategori " . ucfirst($category);

        return view('home', [
            'title' => $title,
            'sub_title' => $sub_title,
            'products' => $filteredProducts,
            'categories' => $categories
        ]);
    }

    // Tampilkan halaman detail produk
    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        if (!$product) {
            abort(404);
        }
        return view('product-detail', ['product' => $product]);
    }

    // Tampilkan halaman keranjang belanja
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    // Tambahkan produk ke keranjang
    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $product = collect($this->products)->firstWhere('id', $id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'qty' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    
    // Perbarui jumlah produk
    public function updateCart(Request $request)
    {
        $id = $request->input('id');
        $qty = $request->input('qty');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }
    
    // Hapus produk dari keranjang
    public function removeFromCart(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}