<?php
// Memasukkan file koneksi.php
include '../koneksi.php'; // Sesuaikan path jika berbeda

// Cek apakah ada parameter ID yang dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Siapkan query untuk menghapus data dari tabel 'product'
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    // Jalankan query
    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke product_table.php dengan pesan sukses
        header("Location: product_table.php?status=deleted");
    } else {
        // Jika gagal, arahkan kembali dengan pesan error
        header("Location: product_table.php?status=delete_error");
    }
    
    $stmt->close();
    $conn->close();
} else {
    // Jika tidak ada ID, arahkan kembali ke halaman tabel
    header("Location: product_table.php");
}
exit();
?>