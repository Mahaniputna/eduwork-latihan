<?php
// Memasukkan file koneksi.php
include '../koneksi.php'; // Sesuaikan path jika berbeda

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Inisialisasi variabel untuk nama file gambar
    $image_path = "";

    // Cek apakah ada file yang diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "images/"; // Tentukan folder untuk menyimpan gambar
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Tipe file yang diizinkan
        $allowed_types = array("jpg", "jpeg", "png", "webp");

        // Cek apakah tipe file sesuai
        if (!in_array($imageFileType, $allowed_types)) {
            // Jika tipe file tidak valid, kembalikan ke halaman form dengan pesan error
            header("Location: input_product.php?status=error_file_type");
            exit();
        }

        // Cek apakah nama file sudah ada
        if (file_exists($target_file)) {
            // Jika nama file sudah ada, kembalikan ke halaman form dengan pesan error
            header("Location: input_product.php?status=duplicate_file");
            exit();
        }
        
        // Pindahkan file gambar ke folder tujuan
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $file_name;
        } else {
            // Jika gagal upload, kembalikan ke halaman form dengan pesan error
            header("Location: input_product.php?status=error_file");
            exit();
        }
    }

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $sql = "INSERT INTO product (name, stock, price, image, description, category) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissss", $name, $stock, $price, $image_path, $description, $category);

    // Jalankan query
    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman input dengan pesan sukses
        header("Location: input_product.php?status=success");
    } else {
        // Jika gagal, arahkan kembali ke halaman input dengan pesan error
        header("Location: input_product.php?status=error_db");
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika tidak disubmit melalui POST, alihkan ke halaman utama
    header("Location: input_product.php");
}
?>