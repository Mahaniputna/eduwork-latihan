<!-- file: resources/views/products-carousel.blade.php -->
<!-- Halaman baru untuk menampilkan semua produk dalam format carousel -->
@extends('template.index')

@section('title', 'Produk Kami')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Produk Kami</h1>
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($products as $index => $product)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <div class="card shadow-sm border-0" style="width: 25rem;">
                            <img src="{{ asset('image/' . ($product['image'] ?? 'default.jpg')) }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 350px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $product['name'] }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product['description'] ?? '', 100) }}</p>
                                <p class="fs-4 fw-bold text-success">Rp {{ number_format($product['price'] ?? 0, 0, ',', '.') }}</p>
                                <a href="{{ route('product.show', ['id' => $product['id']]) }}" class="btn btn-secondary">Lihat Detail</a>
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                                    <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection