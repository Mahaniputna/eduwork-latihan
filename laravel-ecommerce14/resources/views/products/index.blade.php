@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Produk</h1>

    {{-- Product Grid --}}
    <div class="row">
        @forelse($products as $product)
            {{-- Each product card, set to take 3 columns on medium screens and up --}}
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <div class="text-muted text-center py-5">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ $product->category ? $product->category->name : '-' }}</p>
                        <p class="card-text">{{ $product->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle mb-0 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                            <a href="{{ url('add-to-cart/' . $product->id) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk</p>
            </div>
        @endforelse
    </div>

    <p class="text-muted mt-4">
        Menampilkan {{ $products->firstItem() }} sampai {{ $products->lastItem() }} dari total {{ $products->total() }} produk
    </p>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection