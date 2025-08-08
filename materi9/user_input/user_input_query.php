<?php
// Memasukkan file koneksi
include '../koneksi.php';

// Memeriksa jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Validasi input
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect ke halaman user_input.php dengan pesan error
        header("Location: user_input.php?status=error");
        exit();
    } else {
        // Membersihkan input dari karakter yang tidak diinginkan
        $name = htmlspecialchars(stripslashes(trim($name)));
        $email = htmlspecialchars(stripslashes(trim($email)));

        // Menyiapkan statement SQL untuk insert data
        $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $email);

        // Menjalankan query
        if ($stmt->execute()) {
            // Redirect ke halaman user_input.php dengan pesan sukses
            header("Location: user_input.php?status=success");
            exit();
        } else {
            // Redirect ke halaman user_input.php dengan pesan error
            header("Location: user_input.php?status=error_db");
            exit();
        }

        // Menutup statement
        $stmt->close();
    }
} else {
    // Redirect jika halaman diakses langsung
    header("Location: user_input.php");
    exit();
}

// Menutup koneksi
$conn->close();
?>