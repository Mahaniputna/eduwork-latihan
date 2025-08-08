<?php
// Memasukkan file koneksi.php
include '../koneksi.php'; // Sesuaikan path jika berbeda

// Cek apakah data form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form edit
    $id = $_POST['id'];
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $old_image = $_POST['old_image']; // Nama gambar lama dari input hidden

    // Inisialisasi variabel untuk nama gambar baru
    $new_image = $old_image;

    // Tentukan path ke direktori gambar
    $target_dir = "images/"; 

    // Cek apakah ada file gambar baru yang diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Daftar tipe file yang diizinkan
        $allowed_types = array("jpg", "jpeg", "png", "webp");

        // Verifikasi tipe file
        if (!in_array($imageFileType, $allowed_types)) {
            header("Location: edit_product.php?id=" . $id . "&status=error_file_type");
            exit();
        }

        // Pindahkan file gambar baru ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $new_image = $file_name; // Simpan nama file baru
            
            // Logika untuk menghapus gambar lama
            // Hapus gambar lama HANYA JIKA ada gambar baru yang diunggah
            // dan file lama bukan file gambar default (jika ada)
            // serta bukan file gambar yang sama
            if (!empty($old_image) && file_exists($target_dir . $old_image) && $old_image !== $new_image) {
                unlink($target_dir . $old_image);
            }
        } else {
            // Jika gagal upload, kembali ke halaman edit dengan pesan error
            header("Location: edit_product.php?id=" . $id . "&status=error_file");
            exit();
        }
    }

    // Buat query UPDATE
    $sql = "UPDATE product SET 
            name = ?, 
            stock = ?, 
            price = ?, 
            image = ?, 
            description = ?, 
            category = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssi", $name, $stock, $price, $new_image, $description, $category, $id);

    // Jalankan query
    if ($stmt->execute()) {
        header("Location: product_table.php?status=success");
    } else {
        header("Location: edit_product.php?id=" . $id . "&status=error_db");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>