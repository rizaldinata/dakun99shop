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


        return view('user.cart.index', compact('carts'));
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

        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return redirect()->back()->with('error', "Stok tidak cukup untuk produk: {$cart->product->name}");
            }
        }

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'status' => 'menunggu',
        ]);

        foreach ($carts as $cart) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);

            $cart->product->decrement('stock', $cart->quantity);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect('/dashboard')->with('success', 'Checkout berhasil! Pesanan sedang diproses.');
    }
}