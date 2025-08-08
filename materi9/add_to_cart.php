<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $product = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'description' => $description,
        'category' => $category,
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $product_exists = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            $_SESSION['cart'][$key]['quantity']++;
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        $_SESSION['cart'][] = $product;
    }

    // Arahkan kembali ke product.php
    header('Location: product.php');
    exit();
} else {
    header('Location: product.php');
    exit();
}
?>