<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_to_remove = $_POST['id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id_to_remove) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Mengatur ulang indeks array agar tidak ada celah
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    header('Location: cart.php');
    exit();
} else {
    header('Location: cart.php');
    exit();
}
?>