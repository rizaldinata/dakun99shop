@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Transaksi</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                    <tr>
                        <td>{{ $t->user->name }}</td>
                        <td>{{ $t->alamat }}</td>
                        <td>
                            @if ($t->status === 'dikirim')
                                <span class="badge bg-success">Dikirim</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach ($t->items as $item)
                                    <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if ($t->status === 'menunggu')
                                <form action="{{ route('admin.transactions.update', $t->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-primary">Kirim</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.transactions.show', $t->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
