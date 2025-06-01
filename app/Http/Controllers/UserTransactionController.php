<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class UserTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        // Batasi agar user hanya bisa lihat transaksi miliknya
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak berhak melihat transaksi ini.');
        }

        $transaction->load('items.product');

        return view('user.transactions.show', compact('transaction'));
    }
}