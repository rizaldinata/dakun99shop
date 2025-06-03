@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
    {{-- Carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100 rounded" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100 rounded" alt="Banner 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Kartu Produk --}}
    <h3 class="mb-3">Produk Terbaru</h3>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.png') }}"
                        class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold">{{ $product->name }}</h6>
                        <p class="text-muted mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-sm btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk.</p>
            </div>
        @endforelse
    </div>
@endsection
