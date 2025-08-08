<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .table-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>
<body>
<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Toko Online</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="product.php">
              <i class="fas fa-box"></i> Produk
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            <i class="fas fa-shopping-cart"></i> Keranjang
            <?php 
            $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
            if ($cart_count > 0) {
                echo '<span class="badge bg-danger">' . $cart_count . '</span>';
            }
            ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Keranjang Belanja Anda</h2>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                $row_number = 1;
                foreach ($_SESSION['cart'] as $key => $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                ?>
                    <tr>
                        <th scope="row"><?php echo $row_number++; ?></th>
                        <td><?php echo $item['name']; ?></td>
                        <td>
                            <?php
                            $image_path = $item['image'];
                            if (strpos($image_path, 'http') === 0 || strpos($image_path, 'https') === 0) {
                                $image_src = $image_path;
                            } else {
                                $image_src = "product_input/images/" . $image_path;
                            }
                            ?>
                            <img src="<?php echo $image_src; ?>" class="table-image" alt="<?php echo $item['name']; ?>">
                        </td>
                        <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                        <td>
                            <form action="update_cart.php" method="post" class="d-flex">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" class="form-control me-2" style="width: 80px;" min="1" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                        <td>
                            <form action="remove_from_cart.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="fw-bold">
                    <td colspan="5" class="text-end">Total</td>
                    <td>Rp <?php echo number_format($total_price, 0, ',', '.'); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <a href="product.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
            </a>
            <a href="checkout.php" class="btn btn-success btn-lg">Checkout</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Keranjang belanja Anda kosong. <a href="product.php" class="alert-link">Mulai belanja sekarang!</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>