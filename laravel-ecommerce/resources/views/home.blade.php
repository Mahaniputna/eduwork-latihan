<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Ecommerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h1 class="display-4"> {{$title}} </h1>
            <p class="lead"> {{$sub_title}} </p>
            <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Featured Products</h2>
            <div class="row g-4">
                @foreach ($products as $product)
                <!-- Product Card 1 -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset ($product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                            <p class="fw-bold">{{"Rp " . number_format($product['price'], 0, ",", ".")}}</p>
                            <a href="#" class="btn btn-outline-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            &copy; 2024 Ecommerce Store. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>