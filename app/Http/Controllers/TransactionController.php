<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ref_no' => 'required|unique:transactions',
            'date' => 'required|date',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'trans_type' => 'required|string',
            'balance' => 'required|numeric',
        ]);

        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'ref_no' => 'required|unique:transactions,ref_no,' . $transaction->id,
            'date' => 'required|date',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'trans_type' => 'required|string',
            'balance' => 'required|numeric',
        ]);

        $transaction->update($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
