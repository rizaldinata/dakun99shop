@extends('layouts.user')

@section('title', 'Keranjang Saya')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Keranjang Saya</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($carts->isEmpty())
            <div class="text-center text-muted">
                <p>Keranjang Anda kosong.</p>
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Belanja Sekarang</a>
            </div>
        @else
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($carts as $cart)
                                @php
                                    $subtotal = $cart->product->price * $cart->quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ Storage::disk('s3')->url($cart->product->image) }}"
                                            alt="{{ $cart->product->name }}" class="me-3"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>{{ $cart->product->name }}</div>
                                    </td>
                                    <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mb-3 mt-4">
                    <label for="alamat" class="form-label">Alamat Pengiriman</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali Belanja
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-credit-card me-1"></i> Checkout Sekarang
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
