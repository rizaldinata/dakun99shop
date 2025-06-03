<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil produk terbaru (maksimal 8 untuk ditampilkan)
        $products = Product::latest()->take(8)->get();
        
        // Hitung total produk
        $totalProducts = Product::count();
        
        // Hitung total pesanan user (jika sudah login)
        $userOrders = 0;
        if (Auth::check()) {
            $userOrders = Transaction::where('user_id', Auth::id())->count();
        }
        
        return view('user.dashboard.index', compact('products', 'totalProducts', 'userOrders'));
    }
}