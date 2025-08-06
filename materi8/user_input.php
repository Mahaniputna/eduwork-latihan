<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Input Data User</h4>
                </div>
                <div class="card-body">
                    <?php
                    // Memasukkan file koneksi
                    include 'koneksi.php';

                    // Inisialisasi variabel untuk pesan error
                    $error_message = '';
                    $success_message = '';

                    // Memeriksa jika form telah disubmit
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Mengambil nilai dari form
                        $name = $_POST['name'];
                        $email = $_POST['email'];

                        // Validasi input
                        if (empty($name)) {
                            $error_message = 'Nama tidak boleh kosong.';
                        } elseif (empty($email)) {
                            $error_message = 'Email tidak boleh kosong.';
                        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $error_message = 'Format email tidak valid.';
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
                                $success_message = 'Data berhasil disimpan!';
                                // Mengosongkan variabel setelah berhasil
                                $name = '';
                                $email = '';
                            } else {
                                $error_message = 'Error: ' . $sql . '<br>' . $conn->error;
                            }

                            // Menutup statement
                            $stmt->close();
                        }
                    }

                    // Menampilkan pesan error atau sukses
                    if (!empty($error_message)) {
                        echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                    }
                    if (!empty($success_message)) {
                        echo '<div class="alert alert-success" role="alert">' . $success_message . '</div>';
                    }

                    // Menutup koneksi
                    $conn->close();
                    ?>

                    <form action="" method="POST" >
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>