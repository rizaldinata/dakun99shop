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
        $products = Product::latest()->take(8)->get(); // produk terbaru
        $allProducts = Product::latest()->paginate(12); // semua produk dengan pagination
        
        $totalProducts = Product::count();
        $userOrders = Auth::check() ? Transaction::where('user_id', Auth::id())->count() : 0;

        return view('user.dashboard.index', compact('products', 'allProducts', 'totalProducts', 'userOrders'));
    }
}