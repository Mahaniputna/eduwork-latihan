<!-- file: resources/views/components/product-card.blade.php -->
<!-- Komponen card produk untuk halaman utama. -->
<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card h-100 shadow-sm border-0">
        <a href="{{ route('product.show', ['id' => $product['id']]) }}">
            <img src="{{ asset('image/' . ($product['image'] ?? 'default.jpg')) }}"
                class="card-img-top"
                alt="{{ $product['name'] ?? 'Produk' }}"
                style="height: 220px; object-fit: cover;">
        </a>
        <div class="card-body">
            <h5 class="card-title fw-bold mb-2">{{ $product['name'] }}</h5>
            <p class="card-text text-muted mb-1">
                {{ Str::limit($product['description'] ?? '', 60) }}
            </p>
            <span class="badge bg-secondary mb-2">{{ $product['category'] ?? 'Tidak ada Kategori' }}</span>
        </div>
        <div class="card-footer bg-white border-0">
            <span class="fw-bold text-success fs-5">
                Rp {{ number_format($product['price'] ?? 0, 0, ',', '.') }}
            </span>
            <form action="{{ route('cart.add') }}" method="POST" class="d-inline float-end">
                @csrf
                <input type="hidden" name="id" value="{{ $product['id'] }}">
                <button type="submit" class="btn btn-primary btn-sm">Tambahkan ke Keranjang</button>
            </form>
        </div>
    </div>
</div>