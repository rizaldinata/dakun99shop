@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>Rp{{ number_format($product->price) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection
