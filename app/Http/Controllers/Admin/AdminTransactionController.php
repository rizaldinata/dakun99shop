<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'items.product'])->latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('user', 'items.product');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update(['status' => 'dikirim']);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Status pesanan berhasil diubah.');
    }
}