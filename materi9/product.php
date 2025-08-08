<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-card {
            min-height: 450px;
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<?php 
session_start();
include 'navbar.php'; 
?>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Produk</h2>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" method="GET" class="d-flex">
                <select name="category" class="form-select me-2">
                    <option value="">Semua Kategori</option>
                    <?php
                    include 'koneksi.php';

                    $sql_categories = "SELECT DISTINCT category FROM product";
                    $result_categories = $conn->query($sql_categories);

                    if ($result_categories->num_rows > 0) {
                        while($category_row = $result_categories->fetch_assoc()) {
                            $selected = (isset($_GET['category']) && $_GET['category'] == $category_row['category']) ? 'selected' : '';
                            echo '<option value="' . $category_row['category'] . '" ' . $selected . '>' . htmlspecialchars($category_row['category']) . '</option>';
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
    
    <div class="row">
        <?php
        $filter_category = isset($_GET['category']) ? $_GET['category'] : '';
        
        $sql = "SELECT id, name, stock, price, image, description, category FROM product";
        if (!empty($filter_category)) {
            $sql .= " WHERE category = '" . $conn->real_escape_string($filter_category) . "'";
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100">
                        <?php
                        $image_path = $row['image'];
                        if (strpos($image_path, 'http') === 0 || strpos($image_path, 'https') === 0) {
                            $image_src = $image_path;
                        } else {
                            // Jalur gambar disesuaikan: dari folder utama ke folder product_input/images/
                            $image_src = "product_input/images/" . $image_path;
                        }
                        ?>
                        <img src="<?php echo $image_src; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text text-muted">Kategori: <?php echo $row['category']; ?></p>
                            <p class="card-text flex-grow-1"><?php echo $row['description']; ?></p>
                            <div class="mt-auto">
                                <h6 class="card-subtitle mb-2 text-primary">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></h6>
                                <p class="card-text">Stok: <?php echo $row['stock']; ?></p>
                                <form action="add_to_cart.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                                    <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                                    <input type="hidden" name="category" value="<?php echo $row['category']; ?>">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-warning" role="alert">Tidak ada produk yang tersedia di kategori ini.</div></div>';
        }

        $conn->close();
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>