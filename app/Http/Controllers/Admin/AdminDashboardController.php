<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalPesanan = Transaction::count();
        $pesananBelumDikirim = Transaction::where('status', '!=', 'dikirim')->count();
        $pesananDikirim = Transaction::where('status', 'dikirim')->count();

        // Total pemasukan dari semua transaksi (harga * quantity)
        $totalPemasukan = TransactionItem::sum(DB::raw('price * quantity'));

        // Misal pengeluaran manual diset atau diambil dari tabel `expenses` (belum tersedia)
        $totalPengeluaran = 0;

        $saldoSekarang = $totalPemasukan - $totalPengeluaran;

        return view('admin.dashboard.index', compact(
            'totalProduk',
            'totalPesanan',
            'pesananBelumDikirim',
            'pesananDikirim',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoSekarang'
        ));
    }
}