<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Product Management</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="input_product.php">Tambah Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product_table.php">Lihat Produk</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Edit Data Produk</h4>
                </div>
                <div class="card-body">
                    <?php
                    // Menampilkan pesan feedback dari proses query
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '<div class="alert alert-success" role="alert">Data produk berhasil diperbarui!</div>';
                        } elseif ($_GET['status'] == 'error_db') {
                            echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada database.</div>';
                        } elseif ($_GET['status'] == 'error_file') {
                            echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan saat mengunggah file.</div>';
                        } elseif ($_GET['status'] == 'error_file_type') {
                            // Pesan error baru untuk tipe file tidak valid
                            echo '<div class="alert alert-danger" role="alert">Gagal memperbarui produk: Tipe file tidak valid. Hanya bisa mengunggah file JPG, JPEG, PNG, atau WEBP.</div>';
                        }
                    }
                    
                    // Pastikan ada parameter ID produk yang dikirimkan
                    if (isset($_GET['id'])) {
                        include '../koneksi.php';
                        $id = $_GET['id'];
                        
                        // Query untuk mengambil data produk berdasarkan ID
                        $sql = "SELECT id, name, stock, price, image, description, category FROM product WHERE id = $id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                    ?>
                            <form action="update_product.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $row['stock']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $row['price']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="current_image" class="form-label">Gambar Saat Ini</label>
                                    <div>
                                        <?php
                                        $image_path = $row['image'];
                                        if (strpos($image_path, 'http') === 0 || strpos($image_path, 'https') === 0) {
                                            $image_src = $image_path;
                                        } else {
                                            $image_src = "images/" . $image_path;
                                        }
                                        ?>
                                        <img src="<?php echo $image_src; ?>" alt="<?php echo $row['name']; ?>" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                    </div>
                                    <label for="image" class="form-label mt-3">Unggah Gambar Baru (Opsional)</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $row['description']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="Sepatu" <?php if($row['category'] == 'Sepatu') echo 'selected'; ?>>Sepatu</option>
                                        <option value="Elektronik" <?php if($row['category'] == 'Elektronik') echo 'selected'; ?>>Elektronik</option>
                                        <option value="Pakaian" <?php if($row['category'] == 'Pakaian') echo 'selected'; ?>>Pakaian</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Update Produk</button>
                            </form>
                    <?php
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Produk tidak ditemukan.</div>';
                        }
                        $conn->close();
                    } else {
                        echo '<div class="alert alert-warning" role="alert">ID produk tidak diberikan.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>