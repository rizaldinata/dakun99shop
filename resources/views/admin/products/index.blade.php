@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Daftar Produk</h1>
            <p class="page-subtitle">Kelola semua produk senjata api Anda</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Data Produk
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 100px;">Gambar</th>
                            <th>Nama Produk</th>
                            <th style="width: 150px;">Harga</th>
                            <th style="width: 100px;">Stok</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td class="text-muted">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                                </td>

                                <!-- Gambar Produk -->
                                <td>
                                    @if ($product->image)
                                        <img src="{{ Storage::disk('s3')->url($product->image) }}" class="img-thumbnail"
                                            alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('images/dakun99shop.png') }}" class="img-thumbnail"
                                            alt="Gambar default">
                                    @endif
                                </td>

                                <!-- Nama Produk -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="product-icon me-3">
                                            <i class="fas fa-box text-warning"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $product->name }}</div>
                                            @if ($product->description)
                                                <small
                                                    class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-success">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @if ($product->stock > 10)
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-warning">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        {{-- <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning"
                                            data-bs-toggle="tooltip" title="Edit Produk">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                title="Hapus Produk">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Produk</h5>
                                        <p class="text-muted mb-3">Mulai tambahkan produk pertama Anda</p>
                                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Produk Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($products->hasPages())
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}
                        dari {{ $products->total() }} produk
                    </div>
                    <div>
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-box fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Total Produk</h5>
                    <h3 class="text-primary">{{ $products->total() ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Stok Tersedia</h5>
                    <h3 class="text-success">{{ $products->where('stock', '>', 0)->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Stok Menipis</h5>
                    <h3 class="text-warning">{{ $products->whereBetween('stock', [1, 10])->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                    <h5 class="card-title">Stok Habis</h5>
                    <h3 class="text-danger">{{ $products->where('stock', 0)->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const alertInstance = new bootstrap.Alert(alert);
                    alertInstance.close();
                }, 5000);
            });
        });
    </script>
@endpush
