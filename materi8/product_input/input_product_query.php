<?php
// Memasukkan file koneksi
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input: memastikan field yang wajib diisi tidak kosong
    if (empty($_POST['name']) || empty($_POST['stock']) || empty($_POST['price']) || empty($_POST['category'])) {
        header("Location: input_product.php?status=error");
        exit();
    }
    
    // Mengambil dan membersihkan input
    $name = htmlspecialchars(stripslashes(trim($_POST['name'])));
    $stock = (int)$_POST['stock'];
    $price = (float)$_POST['price'];
    $description = htmlspecialchars(stripslashes(trim($_POST['description'])));
    $category = htmlspecialchars(stripslashes(trim($_POST['category'])));
    
    $image_path = ''; // Default path gambar kosong

    // Bagian baru: Menangani file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/"; // Folder untuk menyimpan gambar
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_file_name = uniqid() . "." . $file_extension; // Buat nama file unik
        $target_file = $target_dir . $new_file_name;

        // Cek apakah folder images ada, jika tidak, buat
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Pindahkan file dari folder temporary ke folder images
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $new_file_name; // Simpan nama file ke database
        } else {
            header("Location: input_product.php?status=error_file");
            exit();
        }
    }

    // Menyiapkan statement SQL untuk insert data
    $sql = "INSERT INTO product (name, stock, price, image, description, category) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidsis", $name, $stock, $price, $image_path, $description, $category);

    // Menjalankan query
    if ($stmt->execute()) {
        header("Location: input_product.php?status=success");
        exit();
    } else {
        header("Location: input_product.php?status=error_db");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {
    // Redirect jika diakses tanpa submit form
    header("Location: input_product.php");
    exit();
}
?>