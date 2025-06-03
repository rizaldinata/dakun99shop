@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Daftar Pesanan</h1>
            <p class="page-subtitle">Kelola pesanan pelanggan dengan mudah dan cepat</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Rangkuman -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-list fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Total Pesanan</h5>
                    <h3 class="text-primary">{{ $transactions->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-truck fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Dikirim</h5>
                    <h3 class="text-success">{{ $transactions->where('status', 'dikirim')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Menunggu</h5>
                    <h3 class="text-warning">{{ $transactions->where('status', 'menunggu')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-shopping-cart me-2"></i>Data Transaksi
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Item</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $index => $t)
                            <tr>
                                <td class="text-muted">{{ $index + 1 }}</td>
                                <td>{{ $t->user->name }}</td>
                                <td>{{ $t->alamat }}</td>
                                <td class="status-cell">
                                    @if ($t->status === 'dikirim')
                                        <span class="badge bg-success">Dikirim</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($t->items as $item)
                                            <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        @if ($t->status === 'menunggu')
                                            <button type="button" class="btn btn-sm btn-primary btn-kirim"
                                                data-id="{{ $t->id }}"
                                                data-url="{{ route('admin.transactions.update', $t->id) }}"
                                                data-bs-toggle="tooltip" title="Tandai Dikirim">
                                                <i class="fas fa-truck"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('admin.transactions.show', $t->id) }}"
                                            class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Detail Transaksi">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Transaksi</h5>
                                        <p class="text-muted mb-3">Pesanan pelanggan akan tampil di sini secara otomatis</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(el) {
                return new bootstrap.Tooltip(el)
            });

            // Tombol AJAX "Kirim"
            const csrf = '{{ csrf_token() }}';
            document.querySelectorAll('.btn-kirim').forEach(btn => {
                btn.addEventListener('click', function() {
                    const url = this.dataset.url;
                    const row = this.closest('tr');
                    const statusCell = row.querySelector('.status-cell');

                    fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify({})
                        }).then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                statusCell.innerHTML =
                                    '<span class="badge bg-success">Dikirim</span>';
                                this.remove(); // Hapus tombol kirim
                            } else {
                                alert('Gagal mengubah status.');
                            }
                        }).catch(() => alert('Terjadi kesalahan.'));
                });
            });
        });
    </script>
@endpush
