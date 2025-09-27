<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReturn;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    // Web index
    public function index()
    {
        $returns = PurchaseReturn::with(['vendor','product','purchase'])->paginate(10);
        return view('purchase_returns.index', compact('returns'));
    }

    // API index
    public function apiIndex()
    {
        return response()->json(PurchaseReturn::with(['vendor','product','purchase'])->get());
    }

    public function create()
    {
        return view('purchase_returns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'vendor_id' => 'required|exists:vendors,id',
            'description' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'return_inv_amount' => 'required|numeric|min:0',
            'purchase_id' => 'required|exists:purchases,id',
        ]);

        PurchaseReturn::create($data);

        return redirect()->route('purchase_returns.index')->with('success', 'Purchase Return created successfully');
    }
}
