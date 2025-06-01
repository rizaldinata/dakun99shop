@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Semua Produk</h1>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp{{ number_format($product->price) }}</p>
                            <p class="card-text"><small>Stok: {{ $product->stock }}</small></p>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">+ Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada produk</p>
            @endforelse
        </div>

        {{ $products->links() }}
    </div>
@endsection
