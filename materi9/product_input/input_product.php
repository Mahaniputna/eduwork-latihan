<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar_admin.php'; ?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Form Input Data Produk</h4>
                </div>
                <div class="card-body">
                    <?php
                    // Menampilkan pesan feedback dari proses query
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '<div class="alert alert-success" role="alert">Data produk berhasil disimpan!</div>';
                        } elseif ($_GET['status'] == 'error') {
                            echo '<div class="alert alert-danger" role="alert">Gagal menyimpan data. Pastikan semua kolom terisi dengan benar.</div>';
                        } elseif ($_GET['status'] == 'error_db') {
                            echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada database.</div>';
                        } elseif ($_GET['status'] == 'error_file') {
                            echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan saat mengunggah file.</div>';
                        } elseif ($_GET['status'] == 'error_file_type') {
                            echo '<div class="alert alert-danger" role="alert">Tipe file tidak valid. Hanya bisa mengunggah file JPG, JPEG, PNG, atau WEBP.</div>';
                        } elseif ($_GET['status'] == 'duplicate_file') {
                            // Pesan error baru untuk nama file yang sudah ada
                            echo '<div class="alert alert-warning" role="alert">Nama file sudah pernah diinput. Silakan ganti nama file atau unggah file lain.</div>';
                        }
                    }
                    ?>
                    <form action="input_product_query.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Unggah Gambar</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Sepatu">Sepatu</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Pakaian">Pakaian</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>