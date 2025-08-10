<!-- file: resources/views/cart.blade.php -->
<!-- Halaman keranjang belanja. -->
@extends('template.index')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Keranjang Belanja</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(count($cart) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $item)
            @php $total += $item['price'] * $item['qty']; @endphp
            <tr>
                <td>
                    <img src="{{ asset('image/' . ($item['image'] ?? 'default.jpg')) }}"
                         alt="{{ $item['name'] }}"
                         style="width: 50px; height: 50px; object-fit: cover;">
                    {{ $item['name'] }}
                </td>
                <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="form-control text-center mx-2" style="width: 70px;">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                    </form>
                </td>
                <td>Rp{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-end">
        <h4>Total Belanja: Rp{{ number_format($total, 0, ',', '.') }}</h4>
        <button class="btn btn-primary">Checkout</button>
    </div>
    @else
    <p>Keranjang belanja kosong.</p>
    @endif
</div>
@endsection