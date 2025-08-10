<!-- file: resources/views/product-slider.blade.php -->
<!-- Halaman baru untuk menampilkan semua produk dalam format slider/carousel -->
@extends('template.index')

@section('title', 'Produk Kami')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 text-center">Produk Kami</h1>
            <div id="productSlider" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($products as $index => $product)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <img src="{{ asset('image/' . ($product['image'] ?? 'default.jpg')) }}"
                                        class="img-fluid rounded shadow"
                                        alt="{{ $product['name'] }}">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="mb-3">Detail Produk: {{ $product['name'] }}</h2>
                                    <p class="text-muted">Kategori: <span class="badge bg-secondary fs-6">{{ $product['category'] ?? 'Tidak ada Kategori' }}</span></p>
            
                                    @if(isset($product['details']))
                                        @foreach($product['details'] as $key => $detail)
                                            @if(is_array($detail))
                                                @if(isset($detail[0]))
                                                    <p class="mb-0"><b>{{ $key }}:</b> {{ implode(', ', $detail) }}</p>
                                                @else
                                                    <h5 class="mt-4">{{ $key }}</h5>
                                                    <ul class="list-unstyled">
                                                        @foreach($detail as $spec_key => $spec_value)
                                                            <li><b>{{ $spec_key }}:</b> {{ $spec_value }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @else
                                                <p class="mb-0"><b>{{ $key }}:</b> {{ $detail }}</p>
                                            @endif
                                        @endforeach
                                    @endif
            
                                    <p class="fs-4 fw-bold text-success mt-4">Harga: Rp {{ number_format($product['price'] ?? 0, 0, ',', '.') }}</p>
                                    
                                    <h5 class="mt-4">Deskripsi Produk</h5>
                                    <p class="text-muted">{{ $product['description'] }}</p>
            
                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                                        <button type="submit" class="btn btn-primary btn-lg">Tambahkan ke Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection