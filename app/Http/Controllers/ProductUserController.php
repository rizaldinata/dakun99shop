<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductUserController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('produk.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('user.products.show', compact('product'));
    }
}