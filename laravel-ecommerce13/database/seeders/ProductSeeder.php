<?php




namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{


    public function run(): void
    {
            // Seeder untuk product_categories
$categoriesData = [
    ['name' => 'Electronics', 'slug' => Str::slug('Electronics')],
    ['name' => 'Fashion', 'slug' => Str::slug('Fashion')],
    ['name' => 'Books', 'slug' => Str::slug('Books')],
    ['name' => 'Home', 'slug' => Str::slug('Home')],
    ['name' => 'Sports', 'slug' => Str::slug('Sports')],
];

foreach ($categoriesData as $category) {
    DB::table('product_categories')->updateOrInsert(
        ['name' => $category['name']]
        );
}

// Seeder untuk products (5 produk per kategori)
$categories = DB::table('product_categories')->pluck('id', 'name')->toArray();

$products = [
    // Electronics
    [
        'name' => 'Smartphone X',
        'slug' => Str::slug('Smartphone X'),
        'description' => 'Latest smartphone with advanced features.',
        'price' => 5000000,
        'image' => 'smartphone_x.jpg',
        'stock' => 100,
        'product_category_id' => $categories['Electronics'],
    ],
    [
        'name' => 'Wireless Headphones',
        'slug' => Str::slug('Wireless Headphones'),
        'description' => 'Noise cancelling headphones.',
        'price' => 1500000,
        'image' => 'wireless_headphones.jpg',
        'stock' => 50,
        'product_category_id' => $categories['Electronics'],
    ],
    [
        'name' => 'Smartwatch Pro',
        'slug' => Str::slug('Smartwatch Pro'),
        'description' => 'Fitness tracking smartwatch.',
        'price' => 2000000,
        'image' => 'smartwatch_pro.jpg',
        'stock' => 30,
        'product_category_id' => $categories['Electronics'],
    ],
    [
        'name' => 'Bluetooth Speaker',
        'slug' => Str::slug('Bluetooth Speaker'),
        'description' => 'Portable speaker with deep bass.',
        'price' => 800000,
        'image' => 'bluetooth_speaker.jpg',
        'stock' => 20,
        'product_category_id' => $categories['Electronics'],
    ],
    [
        'name' => 'Laptop Ultra',
        'slug' => Str::slug('Laptop Ultra'),
        'description' => 'High performance laptop.',
        'price' => 10000000,
        'image' => 'laptop_ultra.jpg',
        'stock' => 15,
        'product_category_id' => $categories['Electronics'],
    ],

    // Fashion
    [
        'name' => 'Casual T-Shirt',
        'slug' => Str::slug('Casual T-Shirt'),
        'description' => 'Comfortable cotton t-shirt.',
        'price' => 100000,
        'image' => 'casual_tshirt.jpg',
        'stock' => 200,
        'product_category_id' => $categories['Fashion'],
    ],
    [
        'name' => 'Jeans Classic',
        'slug' => Str::slug('Jeans Classic'),
        'description' => 'Classic blue jeans.',
        'price' => 250000,
        'image' => 'jeans_classic.jpg',
        'stock' => 150,
        'product_category_id' => $categories['Fashion'],
    ],
    [
        'name' => 'Sneakers Trendy',
        'slug' => Str::slug('Sneakers Trendy'),
        'description' => 'Trendy sneakers for daily wear.',
        'price' => 400000,
        'image' => 'sneakers_trendy.jpg',
        'stock' => 100,
        'product_category_id' => $categories['Fashion'],
    ],
    [
        'name' => 'Leather Jacket',
        'slug' => Str::slug('Leather Jacket'),
        'description' => 'Stylish leather jacket.',
        'price' => 750000,
        'image' => 'leather_jacket.jpg',
        'stock' => 80,
        'product_category_id' => $categories['Fashion'],
    ],
    [
        'name' => 'Formal Shirt',
        'slug' => Str::slug('Formal Shirt'),
        'description' => 'Elegant formal shirt.',
        'price' => 200000,
        'image' => 'formal_shirt.jpg',
        'stock' => 60,
        'product_category_id' => $categories['Fashion'],
    ],

    // Books
    [
        'name' => 'Novel Adventure',
        'slug' => Str::slug('Novel Adventure'),
        'description' => 'Exciting adventure novel.',
        'price' => 90000,
        'image' => 'novel_adventure.jpg',
        'stock' => 120,
        'product_category_id' => $categories['Books'],
    ],
    [
        'name' => 'Science Book',
        'slug' => Str::slug('Science Book'),
        'description' => 'Educational science book.',
        'price' => 120000,
        'image' => 'science_book.jpg',
        'stock' => 100,
        'product_category_id' => $categories['Books'],
    ],
    [
        'name' => 'History Book',
        'slug' => Str::slug('History Book'),
        'description' => 'Comprehensive history book.',
        'price' => 110000,
        'image' => 'history_book.jpg',
        'stock' => 90,
        'product_category_id' => $categories['Books'],
    ],
    [
        'name' => 'Children Story',
        'slug' => Str::slug('Children Story'),
        'description' => 'Story book for children.',
        'price' => 80000,
        'image' => 'children_story.jpg',
        'stock' => 110,
        'product_category_id' => $categories['Books'],
    ],
    [
        'name' => 'Cookbook',
        'slug' => Str::slug('Cookbook'),
        'description' => 'Recipe cookbook.',
        'price' => 130000,
        'image' => 'cookbook.jpg',
        'stock' => 70,
        'product_category_id' => $categories['Books'],
    ],

    // Home
    [
        'name' => 'Sofa Minimalis',
        'slug' => Str::slug('Sofa Minimalis'),
        'description' => 'Minimalist sofa for living room.',
        'price' => 3000000,
        'image' => 'sofa_minimalis.jpg',
        'stock' => 25,
        'product_category_id' => $categories['Home'],
    ],
    [
        'name' => 'Dining Table',
        'slug' => Str::slug('Dining Table'),
        'description' => 'Wooden dining table.',
        'price' => 2500000,
        'image' => 'dining_table.jpg',
        'stock' => 15,
        'product_category_id' => $categories['Home'],
    ],
    [
        'name' => 'Bed King Size',
        'slug' => Str::slug('Bed King Size'),
        'description' => 'Comfortable king size bed.',
        'price' => 3500000,
        'image' => 'bed_king_size.jpg',
        'stock' => 10,
        'product_category_id' => $categories['Home'],
    ],
    [
        'name' => 'Lamp Modern',
        'slug' => Str::slug('Lamp Modern'),
        'description' => 'Modern design lamp.',
        'price' => 400000,
        'image' => 'lamp_modern.jpg',
        'stock' => 50,
        'product_category_id' => $categories['Home'],
    ],
    [
        'name' => 'Curtain Elegant',
        'slug' => Str::slug('Curtain Elegant'),
        'description' => 'Elegant curtain for windows.',
        'price' => 300000,
        'image' => 'curtain_elegant.jpg',
        'stock' => 40,
        'product_category_id' => $categories['Home'],
    ],

    // Sports
    [
        'name' => 'Football Pro',
        'slug' => Str::slug('Football Pro'),
        'description' => 'Professional football.',
        'price' => 250000,
        'image' => 'football_pro.jpg',
        'stock' => 100,
        'product_category_id' => $categories['Sports'],
    ],
    [
        'name' => 'Tennis Racket',
        'slug' => Str::slug('Tennis Racket'),
        'description' => 'High quality tennis racket.',
        'price' => 600000,
        'image' => 'tennis_racket.jpg',
        'stock' => 80,
        'product_category_id' => $categories['Sports'],
    ],
    [
        'name' => 'Yoga Mat',
        'slug' => Str::slug('Yoga Mat'),
        'description' => 'Comfortable yoga mat.',
        'price' => 150000,
        'image' => 'yoga_mat.jpg',
        'stock' => 90,
        'product_category_id' => $categories['Sports'],
    ],
    [
        'name' => 'Basketball',
        'slug' => Str::slug('Basketball'),
        'description' => 'Durable basketball.',
        'price' => 200000,
        'image' => 'basketball.jpg',
        'stock' => 100,
        'product_category_id' => $categories['Sports'],
    ],
    [
        'name' => 'Running Shoes',
        'slug' => Str::slug('Running Shoes'),
        'description' => 'Lightweight running shoes.',
        'price' => 500000,
        'image' => 'running_shoes.jpg',
        'stock' => 60,
        'product_category_id' => $categories['Sports'],
    ],
];

DB::table('products')->insert($products);
    }
}
