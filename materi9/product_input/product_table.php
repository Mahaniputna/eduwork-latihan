<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk (Tabel)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .table-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
        }
        .btn-add-product {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-add-product:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<?php include 'navbar_admin.php'; ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Tabel Produk</h2>
       
        <a href="input_product.php" class="btn btn-success btn-add-product">
            Tambah Produk
        </a>
    </div>

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
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi.php';

                $sql = "SELECT id, name, stock, price, image, description, category FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row_number = 1;
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
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['id']; ?>)">Hapus</button>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">Tidak ada produk yang tersedia.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fungsi untuk menampilkan konfirmasi hapus menggunakan SweetAlert2
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, redirect ke halaman delete
                window.location.href = `delete_product.php?id=${id}`;
            }
        });
    }
    
    // Tampilkan modal sukses setelah redirect dari delete_product.php
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'deleted') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Dihapus!',
                text: 'Data produk berhasil dihapus.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Hapus parameter status dari URL agar modal tidak muncul lagi saat refresh
                const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.replaceState({path: newUrl}, '', newUrl);
            });
        }
    });
</script>
</body>
</html>