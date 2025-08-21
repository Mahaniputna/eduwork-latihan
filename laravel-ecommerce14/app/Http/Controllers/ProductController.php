<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan semua produk.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(12);
        $categories = ProductCategory::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Tampilkan produk berdasarkan kategori tertentu.
     */
    public function byCategory($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('product_category_id', $category->id)
            ->with('category')
            ->paginate(12);
        $categories = ProductCategory::all();

        return view('products.index', compact('products', 'categories', 'category'));
    }
}