<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseApiController extends Controller
{
    // GET all purchases with details
    public function index(Request $request)
    {
        $query = Purchase::with('vendor', 'details.product', 'details.product.category');
        // $query = Purchase::with(['vendor:id,first_name,last_name,address', 'details.product']);
        // $query = Purchase::with(['vendor:id,first_name,last_name', 'details.product'])
        //     ->select('id', 'vendor_id', 'pur_date', 'inv_amount', 'payment_status'); // only purchase columns you need


        if ($request->filled('payment_status')) {
            $status = strtolower($request->query('payment_status'));

            // Make sure only valid values are allowed
            if (in_array($status, ['paid', 'unpaid', 'overdue'])) {
                $query->where('payment_status', $status);
            }
        }

        return PurchaseResource::collection($query->get());
    }


    // Store a new purchase
    public function store(Request $request)
    {
        $data = $request->validate([
            'pur_date' => 'required|date',
            'pur_inv_barcode' => 'required|string|max:255',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'ven_inv_no' => 'nullable|string|max:255',
            'ven_inv_date' => 'nullable|date',
            'ven_inv_ref' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'discount_percent' => 'nullable|numeric',
            'discount_amt' => 'nullable|numeric',
            'inv_amount' => 'required|numeric',
             'payment_status' => 'required|in:paid,unpaid,overdue',  // ✅ added
        ]);

        $purchase = Purchase::create($data);

        return new PurchaseResource($purchase->load('details'));
    }

    // Show single purchase
    public function show(Purchase $purchase)
    {
        // return new PurchaseResource($purchase->load('details'));
        return new PurchaseResource($purchase->load('details.product'));
    }

    // Update purchase
    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->validate([
            'pur_date' => 'required|date',
            'pur_inv_barcode' => 'required|string|max:255',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'ven_inv_no' => 'nullable|string|max:255',
            'ven_inv_date' => 'nullable|date',
            'ven_inv_ref' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'discount_percent' => 'nullable|numeric',
            'discount_amt' => 'nullable|numeric',
            'inv_amount' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid,overdue',  // ✅ added
        ]);

        $purchase->update($data);

        return new PurchaseResource($purchase->load('details'));
    }

    // Delete purchase
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return response()->json(['message' => 'Purchase deleted successfully']);
    }
}
