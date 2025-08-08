<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
    <h2 class="text-center mb-4">Formulir Checkout</h2>
    <div class="row">
        <div class="col-md-7">
            <h4>Ringkasan Pesanan</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_price = 0;
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                            $row_number = 1;
                            foreach ($_SESSION['cart'] as $item):
                                $subtotal = $item['price'] * $item['quantity'];
                                $total_price += $subtotal;
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row_number++; ?></th>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="4" class="text-end">Total Pembayaran</td>
                            <td>Rp <?php echo number_format($total_price, 0, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <a href="cart.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Keranjang</a>
        </div>
        <div class="col-md-5">
            <h4>Data Pelanggan</h4>
            <form action="process_checkout.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP (WhatsApp)</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Contoh: 628123456789" required>
                    <div class="form-text">Masukkan nomor telepon dalam format internasional, tanpa "+" atau "0" di depan.</div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">
                    <i class="fab fa-whatsapp"></i> Lanjut ke Pembayaran via WhatsApp
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>