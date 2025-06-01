@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Produk</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
