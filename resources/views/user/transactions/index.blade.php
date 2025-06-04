@extends('layouts.user')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="container py-4">
        <h2 class="section-title">Riwayat Transaksi</h2>

        @if ($transactions->isEmpty())
            <div class="empty-state">
                <i class="fas fa-receipt"></i>
                <h5>Belum ada transaksi</h5>
                <p>Transaksi Anda akan muncul di sini setelah melakukan pembelian</p>
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                </a>
            </div>
        @else
            <div class="transaction-list">
                @foreach ($transactions as $trx)
                    @php
                        $total = $trx->items->sum(function ($item) {
                            return $item->quantity * $item->price;
                        });
                        $firstItem = $trx->items->first();
                        $itemCount = $trx->items->count();
                    @endphp
                    <div class="transaction-card">
                        <div class="transaction-header">
                            <div class="transaction-info">
                                <h6 class="transaction-id">#{{ $trx->id }}</h6>
                                <p class="transaction-date">{{ $trx->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="transaction-status">
                                @if ($trx->status == 'dikirim')
                                    <span class="badge status-success">
                                        <i class="fas fa-truck me-1"></i>Dikirim
                                    </span>
                                @elseif($trx->status == 'menunggu')
                                    <span class="badge status-warning">
                                        <i class="fas fa-clock me-1"></i>Menunggu
                                    </span>
                                @else
                                    <span class="badge status-info">
                                        <i class="fas fa-info-circle me-1"></i>{{ ucfirst($trx->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="transaction-body">
                            <div class="product-preview">
                                @if ($firstItem && $firstItem->product)
                                    <div class="product-image">
                                        @if ($firstItem->product->image)
                                            <img src="{{ Storage::disk('s3')->url($firstItem->product->image) }}"
                                                alt="{{ $firstItem->product->name }}">
                                        @else
                                            <img src="{{ asset('images/dakun99shop.png') }}" alt="Default">
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name">{{ $firstItem->product->name }}</h6>
                                        @if ($itemCount > 1)
                                            <p class="more-items">dan {{ $itemCount - 1 }} produk lainnya</p>
                                        @endif
                                        <p class="product-quantity">{{ $firstItem->quantity }} item</p>
                                    </div>
                                @endif
                            </div>

                            <div class="transaction-total">
                                <div class="total-label">Total Belanja</div>
                                <div class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="transaction-footer">
                            <a href="{{ route('user.transactions.show', $trx->id) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- <div class="d-flex justify-content-center mt-4">
                {{ $transactions->links() }}
            </div> --}}
        @endif
    </div>

    <style>
        .transaction-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .transaction-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow-light);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--shadow-medium);
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1.2rem 1.2rem 0;
        }

        .transaction-id {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.2rem;
        }

        .transaction-date {
            font-size: 0.9rem;
            color: var(--text-light);
            margin: 0;
        }

        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .transaction-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.2rem;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .product-preview {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.2rem;
        }

        .more-items {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .product-quantity {
            font-size: 0.85rem;
            color: var(--text-light);
            margin: 0;
        }

        .transaction-total {
            text-align: right;
        }

        .total-label {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .total-amount {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
        }

        .transaction-footer {
            padding: 1rem 1.2rem;
            text-align: right;
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: var(--accent);
        }

        .empty-state h5 {
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .transaction-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .transaction-body {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .transaction-total {
                text-align: left;
                width: 100%;
            }

            .product-preview {
                width: 100%;
            }
        }
    </style>
@endsection
