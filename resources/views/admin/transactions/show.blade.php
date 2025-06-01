@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Transaksi #{{ $transaction->id }}</h1>

        <p><strong>Pemesan:</strong> {{ $transaction->user->name }} ({{ $transaction->user->email }})</p>
        <p><strong>Alamat Pengiriman:</strong> {{ $transaction->alamat }}</p>
        <p><strong>Status:</strong>
            <span class="badge {{ $transaction->status === 'dikirim' ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ ucfirst($transaction->status) }}
            </span>
        </p>

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

        <p><strong>Total:</strong>
            Rp{{ number_format($transaction->items->sum(fn($i) => $i->price * $i->quantity)) }}
        </p>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
    </div>
@endsection
