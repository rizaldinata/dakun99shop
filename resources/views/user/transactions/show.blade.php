@extends('layouts.user')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="container py-4">
        <div class="transaction-detail">
            <!-- Header -->
            <div class="detail-header">
                <div class="header-content">
                    <h2 class="transaction-title">Detail Transaksi #{{ $transaction->id }}</h2>
                    <div class="transaction-meta">
                        <span class="meta-item">
                            <i class="fas fa-calendar me-2"></i>
                            {{ $transaction->created_at->format('d M Y, H:i') }}
                        </span>
                        @if ($transaction->status == 'dikirim')
                            <span class="badge status-success">
                                <i class="fas fa-truck me-1"></i>Dikirim
                            </span>
                        @elseif($transaction->status == 'menunggu')
                            <span class="badge status-warning">
                                <i class="fas fa-clock me-1"></i>Menunggu
                            </span>
                        @else
                            <span class="badge status-info">
                                <i class="fas fa-info-circle me-1"></i>{{ ucfirst($transaction->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="info-card">
                <h5 class="card-title">
                    <i class="fas fa-map-marker-alt me-2"></i>Informasi Pengiriman
                </h5>
                <p class="shipping-address">{{ $transaction->alamat }}</p>
            </div>

            <!-- Products List -->
            <div class="products-card">
                <h5 class="card-title">
                    <i class="fas fa-shopping-bag me-2"></i>Daftar Produk
                </h5>

                <div class="products-list">
                    @php $total = 0; @endphp
                    @foreach ($transaction->items as $item)
                        @php
                            $subtotal = $item->quantity * $item->price;
                            $total += $subtotal;
                        @endphp
                        <div class="product-item">
                            <div class="product-image">
                                @if ($item->product->image)
                                    <img src="{{ Storage::disk('s3')->url($item->product->image) }}"
                                        alt="{{ $item->product->name }}">
                                @else
                                    <img src="{{ asset('images/dakun99shop.png') }}" alt="Default">
                                @endif
                            </div>

                            <div class="product-details">
                                <h6 class="product-name">{{ $item->product->name }}</h6>
                                <p class="product-price">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="product-quantity">
                                <span class="quantity-label">Qty:</span>
                                <span class="quantity-value">{{ $item->quantity }}</span>
                            </div>

                            <div class="product-subtotal">
                                <span class="subtotal-amount">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="total-section">
                    <div class="total-row">
                        <span class="total-label">Total Pembayaran</span>
                        <span class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="action-buttons">
                <a href="{{ route('user.transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>

    <style>
        .transaction-detail {
            max-width: 100%;
            margin: 0 auto;
        }

        .detail-header {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        .transaction-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .transaction-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .meta-item {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .info-card,
        .products-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .card-title i {
            color: var(--primary);
        }

        .shipping-address {
            font-size: 1rem;
            color: var(--text-dark);
            line-height: 1.6;
            margin: 0;
        }

        .products-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .product-item {
            display: grid;
            grid-template-columns: 80px 1fr auto auto;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--bg-main);
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.3rem;
        }

        .product-price {
            font-size: 0.9rem;
            color: var(--text-light);
            margin: 0;
        }

        .product-quantity {
            text-align: center;
            background: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        .quantity-label {
            font-size: 0.8rem;
            color: var(--text-light);
            display: block;
        }

        .quantity-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .product-subtotal {
            text-align: right;
        }

        .subtotal-amount {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
        }

        .total-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid var(--border);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--secondary);
            padding: 1rem 1.5rem;
            border-radius: 8px;
        }

        .total-label {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .action-buttons {
            text-align: center;
            margin-top: 2rem;
        }

        .btn-secondary {
            background: var(--text-light);
            border: none;
            color: var(--white);
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: var(--text-dark);
            color: var(--white);
            transform: translateY(-1px);
        }

        /* Status badges (same as index page) */
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

        @media (max-width: 768px) {
            .transaction-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .product-item {
                grid-template-columns: 60px 1fr;
                gap: 0.8rem;
            }

            .product-quantity,
            .product-subtotal {
                grid-column: 1 / -1;
                margin-top: 0.5rem;
            }

            .product-quantity {
                text-align: left;
                width: fit-content;
            }

            .product-subtotal {
                text-align: left;
            }

            .total-row {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
        }
    </style>
@endsection
