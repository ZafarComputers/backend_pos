<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    // public function index()
    // {
    //     $purchaseReturns = PurchaseReturn::with('vendor')->get();
    //     return view('purchase_returns.index', compact('purchaseReturns'));
    // }

    // public function index(Request $request)
    // {
    //     $query = PurchaseReturn::with('vendor');

    //     if ($request->has('payment_status') && $request->payment_status !== '') {
    //         $query->where('payment_status', $request->payment_status);
    //     }

    //     $purchaseReturns = $query->get();

    //     return view('purchase_returns.index', compact('purchaseReturns'))
    //         ->with('selectedStatus', $request->payment_status);
    // }

    public function index(Request $request)
    {
        $query = Purchase::with('vendor');

        // 🔎 Payment Status filter
        if ($request->has('payment_status') && $request->payment_status !== '') {
            $query->where('payment_status', $request->payment_status);
        }

        $purchases = $query->get();

        return view('purchases.index', compact('purchases'))
            ->with('selectedStatus', $request->payment_status);
    }



    public function create()
    {
        $vendors = Vendor::all();
        $products = Product::all();
        return view('purchase_returns.create', compact('vendors', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'return_date' => 'required|date',
            'return_inv_no' => 'required|string|max:255|unique:purchase_returns,return_inv_no',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'reason' => 'nullable|string',
            'payment_status' => 'required|in:paid,unpaid,overdue',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|integer|exists:products,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discPer' => 'nullable|numeric',
            'details.*.discAmount' => 'nullable|numeric',
        ]);

        $total = collect($data['details'])->sum(function ($d) {
            return ($d['qty'] * $d['unit_price']) - ($d['discAmount'] ?? 0);
        });

        $purchaseReturn = PurchaseReturn::create([
            'return_date' => $data['return_date'],
            'return_inv_no' => $data['return_inv_no'],
            'vendor_id' => $data['vendor_id'],
            'reason' => $data['reason'] ?? null,
            'return_amount' => $total,
            'payment_status' => $data['payment_status'],
        ]);

        foreach ($data['details'] as $detail) {
            $purchaseReturn->details()->create($detail);
        }

        return redirect()->route('purchase_returns.index')->with('success', 'Purchase Return created successfully.');
    }

    public function show(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->load('details.product', 'vendor');
        return view('purchase_returns.show', compact('purchaseReturn'));
    }

    public function edit(PurchaseReturn $purchaseReturn)
    {
        $vendors = Vendor::all();
        $products = Product::all();
        $purchaseReturn->load('details');
        return view('purchase_returns.edit', compact('purchaseReturn', 'vendors', 'products'));
    }

    public function update(Request $request, PurchaseReturn $purchaseReturn)
    {
        $data = $request->validate([
            'return_date' => 'required|date',
            'return_inv_no' => 'required|string|max:255|unique:purchase_returns,return_inv_no,' . $purchaseReturn->id,
            'vendor_id' => 'required|integer|exists:vendors,id',
            'reason' => 'nullable|string',
            'payment_status' => 'required|in:paid,unpaid,overdue',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|integer|exists:products,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discPer' => 'nullable|numeric',
            'details.*.discAmount' => 'nullable|numeric',
        ]);

        $total = collect($data['details'])->sum(function ($d) {
            return ($d['qty'] * $d['unit_price']) - ($d['discAmount'] ?? 0);
        });

        $purchaseReturn->update([
            'return_date' => $data['return_date'],
            'return_inv_no' => $data['return_inv_no'],
            'vendor_id' => $data['vendor_id'],
            'reason' => $data['reason'] ?? null,
            'return_amount' => $total,
            'payment_status' => $data['payment_status'],
        ]);

        // Replace details
        $purchaseReturn->details()->delete();
        foreach ($data['details'] as $detail) {
            $purchaseReturn->details()->create($detail);
        }

        return redirect()->route('purchase_returns.index')->with('success', 'Purchase Return updated successfully.');
    }

    public function destroy(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->delete();
        return redirect()->route('purchase_returns.index')->with('success', 'Purchase Return deleted successfully.');
    }
}
