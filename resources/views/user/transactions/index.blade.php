@extends('layouts.user')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Riwayat Transaksi</h2>

        @if ($transactions->isEmpty())
            <div class="text-muted text-center">Belum ada transaksi.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $trx)
                            @php
                                $total = $trx->items->sum(function ($item) {
                                    return $item->quantity * $item->price;
                                });
                            @endphp
                            <tr>
                                <td>#{{ $trx->id }}</td>
                                <td>{{ $trx->created_at->format('d M Y') }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($trx->status) }}</span></td>
                                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('user.transactions.show', $trx->id) }}" class="btn btn-sm btn-primary">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
