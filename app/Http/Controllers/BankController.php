<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::with('transactionType')->paginate(10);
        return view('banks.index', compact('banks'));
    }

    public function create()
    {
        $transactionTypes = TransactionType::all();
        return view('banks.create', compact('transactionTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'acc_holder_name' => 'required|string|max:255',
            'acc_no' => 'required|string|max:255|unique:banks',
            'acc_type' => 'required|in:Current,Saving',
            'op_balance' => 'required|numeric',
            'note' => 'nullable|string',
            'status' => 'required|in:Active,Closed',
        ]);

        Bank::create($data);
        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');
    }

    public function show(Bank $bank)
    {
        return view('banks.show', compact('bank'));
    }

    public function edit(Bank $bank)
    {
        $transactionTypes = TransactionType::all();
        return view('banks.edit', compact('bank', 'transactionTypes'));
    }

    public function update(Request $request, Bank $bank)
    {
        $data = $request->validate([
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'acc_holder_name' => 'required|string|max:255',
            'acc_no' => 'required|string|max:255|unique:banks,acc_no,' . $bank->id,
            'acc_type' => 'required|in:Current,Saving',
            'op_balance' => 'required|numeric',
            'note' => 'nullable|string',
            'status' => 'required|in:Active,Closed',
        ]);

        $bank->update($data);
        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
    }
}
