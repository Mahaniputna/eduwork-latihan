<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['quantity'])) {
    $id_to_update = $_POST['id'];
    $new_quantity = $_POST['quantity'];

    if ($new_quantity > 0) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id_to_update) {
                $_SESSION['cart'][$key]['quantity'] = $new_quantity;
                break;
            }
        }
    }

    header('Location: cart.php');
    exit();
} else {
    header('Location: cart.php');
    exit();
}
?>