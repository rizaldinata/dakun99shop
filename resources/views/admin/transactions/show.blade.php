@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Detail Transaksi</h1>
            <p class="page-subtitle">Informasi lengkap tentang pesanan pelanggan</p>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Transaksi #{{ $transaction->id }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Pemesan:</strong> {{ $transaction->user->name }} <br>
                <small class="text-muted">({{ $transaction->user->email }})</small>
            </p>
            <p><strong>Alamat Pengiriman:</strong> {{ $transaction->alamat }}</p>
            <p><strong>Status:</strong>
                <span class="badge {{ $transaction->status === 'dikirim' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Daftar Produk</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                @foreach ($transaction->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $item->product->name }} <br>
                            <small class="text-muted">x{{ $item->quantity }} @ Rp{{ number_format($item->price) }}</small>
                        </div>
                        <span class="fw-semibold text-primary">Rp{{ number_format($item->quantity * $item->price) }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="d-flex justify-content-end">
                <h5>Total:
                    <span class="text-success">
                        Rp{{ number_format($transaction->items->sum(fn($i) => $i->price * $i->quantity)) }}
                    </span>
                </h5>
            </div>
        </div>
    </div>
@endsection
