@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transaksi Saya</h1>

        @if ($transactions->isEmpty())
            <p>Belum ada transaksi.</p>
        @else
            @foreach ($transactions as $t)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <strong>Transaksi #{{ $t->id }}</strong>
                        <span class="badge {{ $t->status === 'dikirim' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ ucfirst($t->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <p><strong>Alamat:</strong> {{ $t->alamat }}</p>
                        <ul>
                            @foreach ($t->items as $item)
                                <li>{{ $item->product->name }} (x{{ $item->quantity }}) -
                                    Rp{{ number_format($item->price) }}</li>
                                <a href="{{ route('user.transactions.show', $t->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Lihat Detail
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
