<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BankResource;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankApiController extends Controller
{
    public function index()
    {
        return BankResource::collection(Bank::with('transactionType')->get());
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

        $bank = Bank::create($data);
        return new BankResource($bank);
    }

    public function show(Bank $bank)
    {
        return new BankResource($bank->load('transactionType'));
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
        return new BankResource($bank);
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return response()->json(['message' => 'Bank deleted successfully']);
    }
}
