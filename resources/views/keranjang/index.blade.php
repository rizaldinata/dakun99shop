@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Keranjang Saya</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($carts->isEmpty())
            <p>Keranjang kosong.</p>
        @else
            <table class="table table-bordered">
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
                            <td>{{ $cart->product->name }}</td>
                            <td>Rp{{ number_format($cart->product->price) }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp{{ number_format($subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th>Rp{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
            @if (!$carts->isEmpty())
                <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="alamat">Alamat Pengiriman</label>
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            @endif
        @endif
    </div>
@endsection
