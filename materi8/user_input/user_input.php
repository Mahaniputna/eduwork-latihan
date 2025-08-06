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
                    // Menampilkan pesan feedback berdasarkan parameter URL
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>';
                        } elseif ($_GET['status'] == 'error') {
                            echo '<div class="alert alert-danger" role="alert">Gagal menyimpan data. Nama dan email harus diisi.</div>';
                        } elseif ($_GET['status'] == 'error_db') {
                            echo '<div class="alert alert-danger" role="alert">Gagal menyimpan data ke database. Silakan coba lagi.</div>';
                        }
                    }
                    ?>

                    <form action="user_input_query.php" method="POST" >
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