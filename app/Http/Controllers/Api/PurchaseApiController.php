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
            'payment_status' => 'required|in:paid,unpaid,overdue',

            // ✅ add validation for details
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
        ]);

        // ✅ Calculate total invoice amount before save
        $totalAmount = collect($data['details'])->sum(function ($detail) {
            return ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
        });

        // ✅ Create the purchase
        $purchase = Purchase::create([
            'pur_date' => $data['pur_date'],
            'pur_inv_barcode' => $data['pur_inv_barcode'],
            'vendor_id' => $data['vendor_id'],
            'ven_inv_no' => $data['ven_inv_no'] ?? null,
            'ven_inv_date' => $data['ven_inv_date'] ?? null,
            'ven_inv_ref' => $data['ven_inv_ref'] ?? null,
            'description' => $data['description'] ?? null,
            'discount_percent' => $data['discount_percent'] ?? 0,
            'discount_amt' => $data['discount_amt'] ?? 0,
            'inv_amount' => $totalAmount,
            'payment_status' => $data['payment_status'],
        ]);

        // ✅ Store purchase details
        foreach ($data['details'] as $detail) {
            $purchase->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'unit_price' => $detail['unit_price'],
                'discAmount' => $detail['discAmount'] ?? 0,
                'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
            ]);
        }

        // ✅ Return resource with relations loaded
        return new PurchaseResource($purchase->load(['vendor', 'details.product']));
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
            'payment_status' => 'required|in:paid,unpaid,overdue',

            // ✅ Add validation for details
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
        ]);

        // ✅ Step 1: Update main purchase
        $purchase->update($data);

        // ✅ Step 2: Delete existing details (or you can update selectively)
        $purchase->details()->delete();

        // ✅ Step 3: Recreate details
        foreach ($data['details'] as $detail) {
            $purchase->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'unit_price' => $detail['unit_price'],
                'discAmount' => $detail['discAmount'] ?? 0,
                'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
            ]);
        }

        // ✅ Step 4: Recalculate total
        $totalAmount = collect($data['details'])->sum(function ($detail) {
            return ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
        });
        $purchase->update(['inv_amount' => $totalAmount]);

        // ✅ Step 5: Return Resource
        return new PurchaseResource($purchase->load(['vendor', 'details.product']));
    }


    // Delete purchase
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return response()->json(['message' => 'Purchase deleted successfully']);
    }
}
