@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Selamat datang di panel admin Dakun99 Shop</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Statistik Ringkas -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-box fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Total Produk</h5>
                    <h3 class="text-warning">{{ $totalProduk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Total Pesanan</h5>
                    <h3 class="text-success">{{ $totalPesanan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Belum Dikirim</h5>
                    <h3 class="text-warning">{{ $pesananBelumDikirim }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-truck fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Sudah Dikirim</h5>
                    <h3 class="text-primary">{{ $pesananDikirim }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistik Keuangan -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-wallet fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Total Pemasukan</h5>
                    <h3 class="text-primary">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave fa-2x text-danger mb-2"></i>
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <h3 class="text-danger">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-coins fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Saldo Sekarang</h5>
                    <h3 class="text-success">Rp {{ number_format($saldoSekarang, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
