@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Transaksi #{{ $transaction->id }}</h1>

        <p><strong>Status:</strong>
            <span class="badge {{ $transaction->status === 'dikirim' ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ ucfirst($transaction->status) }}
            </span>
        </p>
        <p><strong>Alamat Pengiriman:</strong> {{ $transaction->alamat }}</p>
        <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>

        <hr>

        <h4>Daftar Produk</h4>
        <ul>
            @foreach ($transaction->items as $item)
                <li>
                    {{ $item->product->name }} (x{{ $item->quantity }}) -
                    Rp{{ number_format($item->price) }}
                </li>
            @endforeach
        </ul>

        <hr>
        <p><strong>Total:</strong>
            Rp{{ number_format($transaction->items->sum(fn($item) => $item->price * $item->quantity)) }}
        </p>

        <a href="{{ route('user.transactions.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
    </div>
@endsection
