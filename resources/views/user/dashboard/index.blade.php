@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
    {{-- Greeting Section --}}
    <div class="container mb-5">
        <div class="greeting-section">
            <h2 class="greeting-title">Selamat datang di Dakun GunShop</h2>
            <p class="greeting-text">Platform terpercaya untuk skin senjata PUBG dengan koleksi eksklusif, harga terjangkau,
                dan layanan terbaik untuk para gamer Indonesia.</p>
        </div>
    </div>

    {{-- Carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://dakun99shop-bucket.s3.ap-southeast-2.amazonaws.com/asset/banner3.png" class="d-block w-100"
                    alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://dakun99shop-bucket.s3.ap-southeast-2.amazonaws.com/asset/banner2.png"
                    class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="https://dakun99shop-bucket.s3.ap-southeast-2.amazonaws.com/asset/banner1.png"
                    class="d-block w-100" alt="Banner 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Produk Terbaru --}}
    <h3 class="section-title">Produk Terbaru</h3>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100 position-relative">
                    {{-- Optional Badge --}}
                    <span class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px;">Baru</span>
                    @if ($product->image)
                        <img src="{{ Storage::disk('s3')->url($product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/dakun99shop.png') }}" class="card-img-top" alt="Gambar default">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.show', $product->id) }}" class="btn btn-sm btn-primary w-100">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Belum ada produk.
            </div>
        @endforelse
    </div>

    {{-- Semua Produk --}}
    <h3 class="section-title mt-5">Semua Produk</h3>
    <div class="row">
        @forelse ($allProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    @if ($product->image)
                        <img src="{{ Storage::disk('s3')->url($product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/dakun99shop.png') }}" class="card-img-top" alt="Gambar default">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.show', $product->id) }}" class="btn btn-sm btn-primary w-100">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Tidak ada produk tersedia.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $allProducts->links('pagination::bootstrap-5') }}
    </div>

    {{-- Footer --}}
    <footer class="full-width-footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-brand">
                    <h4>Dakun GunShop</h4>
                    <p>Platform terpercaya untuk skin PUBG</p>
                </div>
                <div class="footer-contact">
                    <h5>Hubungi Kami</h5>
                    <a href="mailto:support@dakun99shop.com">support@dakungunshop.com</a>
                </div>
                <div class="footer-info">
                    <h5>Keunggulan Kami</h5>
                    <ul>
                        <li>Koleksi Eksklusif</li>
                        <li>Harga Terjangkau</li>
                        <li>Layanan 24/7</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ now()->year }} Dakun GunShop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Custom Pagination CSS --}}
    <style>
        .pagination {
            margin-top: 1.5rem;
        }

        .pagination .page-item .page-link {
            color: #7a491f;
            border: 1px solid #d2b48c;
            font-weight: 500;
            padding: 0.5rem 0.9rem;
            border-radius: 6px;
            margin: 0 4px;
            transition: all 0.2s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #7a491f;
            border-color: #7a491f;
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            color: #999;
        }

        .pagination .page-item .page-link:hover {
            background-color: #d2b48c;
            color: #fff;
            border-color: #d2b48c;
        }

        /* Simple Greeting Section */
        .greeting-section {
            text-align: center;
            padding: 2rem 0;
            margin-bottom: 1rem;
        }

        .greeting-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .greeting-text {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Full Width Footer */
        .full-width-footer {
            background: var(--white);
            border-top: 1px solid var(--border);
            margin-top: 4rem;
            padding: 3rem 0 1.5rem;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
        }

        .footer-main {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border);
        }

        .footer-brand h4 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .footer-brand p {
            color: var(--text-light);
            margin: 0;
            font-size: 0.95rem;
        }

        .footer-contact h5,
        .footer-info h5 {
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .footer-contact a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .footer-contact a:hover {
            background: var(--secondary);
            border-color: var(--accent);
        }

        .footer-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-info ul li {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            padding-left: 1rem;
            position: relative;
        }

        .footer-info ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: 600;
        }

        .footer-bottom {
            text-align: center;
        }

        .footer-bottom p {
            color: var(--text-light);
            margin: 0;
            font-size: 0.85rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .greeting-title {
                font-size: 1.5rem;
            }

            .greeting-text {
                font-size: 0.95rem;
                padding: 0 1rem;
            }

            .footer-main {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                text-align: center;
            }

            .footer-contact a {
                display: block;
                margin: 0 auto;
                width: fit-content;
            }
        }

        @media (max-width: 576px) {
            .greeting-section {
                padding: 1.5rem 1rem;
            }

            .greeting-title {
                font-size: 1.3rem;
            }
        }
    </style>
@endsection
