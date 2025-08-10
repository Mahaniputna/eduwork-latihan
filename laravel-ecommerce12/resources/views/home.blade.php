<!-- file: resources/views/home.blade.php -->
<!-- Halaman utama yang menampilkan daftar produk. -->
@extends('template.index')

@section('title', 'Home')

@section('content')
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h1 class="display-4"> {{$title}} </h1>
            <p class="lead"> {{$sub_title}} </p>
            <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Featured Products</h2>
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('home') }}" class="btn btn-outline-primary mx-2">Semua Produk</a>
                @foreach ($categories as $category)
                    <a href="{{ route('products.category', ['category' => $category]) }}" class="btn btn-outline-primary mx-2">{{ ucfirst($category) }}</a>
                @endforeach
            </div>
            <div class="row g-4">
                @foreach ($products as $product)
                <x-product-card :product="$product"></x-product-card>
                @endforeach
            </div>
        </div>
    </section>
@endsection