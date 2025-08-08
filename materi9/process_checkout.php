<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Ambil data pelanggan dari form
    $customer_name = $_POST['name'];
    $customer_phone = $_POST['phone'];
    $customer_address = $_POST['address'];

    // Nomor WhatsApp penerima pesanan
    $whatsapp_number = "6281228292778"; // Ganti dengan nomor WhatsApp Anda (tanpa tanda +)

    // Buat pesan untuk WhatsApp
    $message = "*PEMESANAN BARU*\n\n";
    $message .= "Data Pelanggan:\n";
    $message .= "Nama: " . $customer_name . "\n";
    $message .= "Nomor HP: " . $customer_phone . "\n";
    $message .= "Alamat: " . $customer_address . "\n\n";

    $message .= "Detail Pesanan:\n";
    $message .= "-----------------------------------\n";
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total_price += $subtotal;
        $message .= "- " . $item['name'] . " (" . $item['quantity'] . " pcs)\n";
        $message .= "  Harga: Rp " . number_format($item['price'], 0, ',', '.') . "\n";
        $message .= "  Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "\n";
        $message .= "-----------------------------------\n";
    }

    $message .= "\nTotal Pembayaran: *Rp " . number_format($total_price, 0, ',', '.') . "*\n\n";
    $message .= "Mohon konfirmasi pesanan ini.\nTerima kasih!";

    // URL-encode pesan agar bisa dimasukkan ke URL WhatsApp
    $encoded_message = urlencode($message);

    // Buat URL untuk redirect ke WhatsApp
    $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . $encoded_message;

    // Bersihkan keranjang belanja setelah diproses (opsional, bisa disesuaikan)
    unset($_SESSION['cart']);

    // Redirect pengguna ke URL WhatsApp
    header("Location: " . $whatsapp_url);
    exit();
} else {
    // Redirect kembali ke halaman keranjang jika tidak ada data
    header('Location: cart.php');
    exit();
}
?>