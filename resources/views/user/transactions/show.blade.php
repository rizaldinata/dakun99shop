@extends('layouts.user')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="container py-4">
        <h2>Detail Transaksi #{{ $transaction->id }}</h2>

        <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y') }}</p>
        <p><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($transaction->status) }}</span></p>
        <p><strong>Alamat Pengiriman:</strong> {{ $transaction->alamat }}</p>

        <hr>

        <h5>Daftar Produk</h5>
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
                @foreach ($transaction->items as $item)
                    @php
                        $subtotal = $item->quantity * $item->price;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('user.transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
        </a>
    </div>
@endsection
