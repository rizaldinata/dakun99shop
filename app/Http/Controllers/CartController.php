<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();


        return view('keranjang.index', compact('carts'));
    }

    public function add(Product $product)
    {
        $user = Auth::user();

        // Cek apakah produk sudah di keranjang
        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
        ]);

        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Buat transaksi utama
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'status' => 'menunggu',
        ]);

        // Simpan semua item dari keranjang ke transaction_items
        foreach ($carts as $cart) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);

            // Kurangi stok produk
            $cart->product->decrement('stock', $cart->quantity);
        }

        // Hapus isi keranjang
        Cart::where('user_id', $user->id)->delete();

        return redirect('/produk')->with('success', 'Checkout berhasil! Pesanan sedang diproses.');
    }
}