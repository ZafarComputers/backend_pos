<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // Web Index
    public function index()
    {
        $purchases = Purchase::with('details.product')->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    // API Index
    public function apiIndex()
    {
        return response()->json(Purchase::with('details.product')->get());
    }

    public function create()
    {
        return view('purchases.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'ven_inv_no' => 'nullable|string',
            'ven_inv_date' => 'nullable|date',
            'ven_inv_ref' => 'nullable|string',
            'description' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'discount_percent' => 'nullable|numeric|min:0',
            'discount_amt' => 'nullable|numeric|min:0',
            'inv_amount' => 'required|numeric|min:0',
        ]);

        $purchase = Purchase::create($data);

        return redirect()->route('purchases.index')->with('success', 'Purchase created');
    }

}
