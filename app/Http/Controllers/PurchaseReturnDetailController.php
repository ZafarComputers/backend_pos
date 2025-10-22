<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReturnDetail;
use Illuminate\Http\Request;

class PurchaseReturnDetailController extends Controller
{
    // Web index
    public function index()
    {
        $details = PurchaseReturnDetail::with(['purchaseReturn','product'])->paginate(10);
        return view('purchase_return_details.index', compact('details'));
    }

    // API index
    public function apiIndex()
    {
        return response()->json(PurchaseReturnDetail::with(['purchaseReturn','product'])->get());
    }

    public function create()
    {
        return view('purchase_return_details.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_return_id' => 'required|exists:purchase_returns,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'pur_price' => 'required|numeric|min:0',
        ]);

        PurchaseReturnDetail::create($data);

        return redirect()->route('purchase_return_details.index')->with('success', 'Return detail added successfully');
    }
}
