<!-- file: resources/views/product-detail.blade.php -->
<!-- Halaman detail produk. -->
@extends('template.index')

@section('title', $product['name'])

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('image/' . ($product['image'] ?? 'default.jpg')) }}"
                 class="img-fluid rounded shadow"
                 alt="{{ $product['name'] }}">
        </div>
        <div class="col-md-6">
            <h1 class="mb-3">Detail Produk: {{ $product['name'] }}</h1>
            <p class="text-muted">Kategori: <span class="badge bg-secondary fs-6">{{ $product['category'] ?? 'Tidak ada Kategori' }}</span></p>

            @if(isset($product['details']))
                @foreach($product['details'] as $key => $detail)
                    @if(is_array($detail))
                        @if(isset($detail[0]))
                            <!-- Untuk array sederhana seperti 'Warna Tersedia' -->
                            <p class="mb-0"><b>{{ $key }}:</b> {{ implode(', ', $detail) }}</p>
                        @else
                            <!-- Untuk array bersarang seperti 'Spesifikasi Teknis' -->
                            <h5 class="mt-4">{{ $key }}</h5>
                            <ul class="list-unstyled">
                                @foreach($detail as $spec_key => $spec_value)
                                    <li><b>{{ $spec_key }}:</b> {{ $spec_value }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <!-- Untuk pasangan kunci-nilai sederhana -->
                        <p class="mb-0"><b>{{ $key }}:</b> {{ $detail }}</p>
                    @endif
                @endforeach
            @endif

            <p class="fs-4 fw-bold text-success mt-4">Harga: Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
            
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
@endsection