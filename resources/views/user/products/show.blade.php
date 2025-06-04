@extends('layouts.user')

@section('title', $product->name)

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ Storage::disk('s3')->url($product->image) }}" class="img-fluid rounded border"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p>{{ $product->description }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-cart-plus me-1"></i> Tambah ke Keranjang
                    </button>
                </form>

                <a href="{{ route('dashboard.index') }}" class="btn btn-link mt-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection
