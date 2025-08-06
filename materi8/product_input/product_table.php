<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk (Tabel)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-image {
            width: 100px;
            height: 100px;
            object-fit: contain; /* Mengubah dari 'cover' menjadi 'contain' */
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tabel Produk</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Memasukkan file koneksi.php
                include '../koneksi.php';

                // Query untuk mengambil semua data dari tabel 'product'
                $sql = "SELECT id, name, stock, price, image, description, category FROM product";
                $result = $conn->query($sql);

                // Memeriksa apakah ada data yang ditemukan
                if ($result->num_rows > 0) {
                    $row_number = 1;
                    // Melakukan perulangan untuk setiap baris data
                    while($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $row_number++; ?></th>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                            <td>
                                <?php
                                $image_path = $row['image'];
                                if (strpos($image_path, 'http') === 0 || strpos($image_path, 'https') === 0) {
                                    $image_src = $image_path;
                                } else {
                                    $image_src = "images/" . $image_path;
                                }
                                ?>
                                <img src="<?php echo $image_src; ?>" class="table-image" alt="<?php echo $row['name']; ?>">
                            </td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="7" class="text-center">Tidak ada produk yang tersedia.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>