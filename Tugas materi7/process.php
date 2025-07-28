<?php
header('Content-Type: application/json'); // Penting: Memberi tahu browser bahwa respons adalah JSON

$response = [
    'status' => '',
    'messages' => [],
    'data' => [],
    'input_values' => [] // Tambahkan untuk mengirim kembali nilai input pada error
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // 1. Validasi Nama Produk
    if (empty($_POST["nama_produk"])) {
        $errors[] = "Nama produk wajib diisi.";
    }

    // 2. Validasi Harga
    $harga_input = $_POST["harga"];
    if (empty($harga_input)) {
        $errors[] = "Harga wajib diisi.";
    } elseif (!is_numeric($harga_input) || (float)$harga_input <= 0) { // Gunakan (float) untuk memastikan perbandingan angka
        $errors[] = "Harga harus berupa angka lebih dari 0.";
    }

    // Ambil dan sanitasi input lainnya
    $nama_produk = htmlspecialchars($_POST["nama_produk"] ?? '');
    $deskripsi = htmlspecialchars($_POST["deskripsi"] ?? '');
    $harga = htmlspecialchars($_POST["harga"] ?? '');
    $kategori = htmlspecialchars($_POST["kategori"] ?? '');

    if (count($errors) > 0) {
        $response['status'] = 'error';
        $response['messages'] = $errors;
        // Kirim kembali nilai input agar form bisa diisi kembali
        $response['input_values'] = [
            'nama_produk' => $_POST['nama_produk'] ?? '',
            'deskripsi' => $_POST['deskripsi'] ?? '',
            'harga' => $_POST['harga'] ?? '',
            'kategori' => $_POST['kategori'] ?? ''
        ];
    } else {
        // Jika tidak ada error, proses data (misalnya, simpan ke database)
        // Untuk contoh ini, kita hanya menyimpan data untuk respons
        $response['status'] = 'success';
        $response['data'] = [
            'nama_produk' => $nama_produk,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'kategori' => $kategori
        ];
    }
} else {
    // Jika diakses langsung tanpa metode POST
    $response['status'] = 'error';
    $response['messages'][] = "Permintaan tidak valid.";
}

echo json_encode($response); // Encode array respons menjadi JSON dan kirim
exit();
?>