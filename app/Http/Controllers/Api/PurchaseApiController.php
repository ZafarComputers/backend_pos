<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseApiController extends Controller
{
    /**
     * Display a listing of purchases.
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['vendor', 'details.product', 'details.product.category', 'paymentMode']);

        if ($request->filled('payment_status')) {
            $status = strtolower($request->query('payment_status'));
            if (in_array($status, ['paid', 'unpaid', 'overdue'])) {
                $query->where('payment_status', $status);
            }
        }

        return PurchaseResource::collection($query->get());
    }

    /**
     * Store a newly created purchase.
     */
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
            'discount_percent' => 'nullable|numeric|min:0',
            'discount_amt' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:paid,unpaid,overdue',

            // ✅ Must be provided
            'payment_mode_id' => 'required|exists:payment_modes,id',
            'transaction_type_id' => 'required|exists:transaction_types,id',

            // ✅ Details validation
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
        ]);

        // ✅ Calculate total amount
        $totalAmount = collect($data['details'])->sum(function ($detail) {
            return ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
        });

        // ✅ Create Purchase
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
            'transaction_type_id' => $data['transaction_type_id'],
            'payment_mode_id' => $data['payment_mode_id'],
        ]);

        // ✅ Save details
        foreach ($data['details'] as $detail) {
            $purchase->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'unit_price' => $detail['unit_price'],
                'discAmount' => $detail['discAmount'] ?? 0,
                'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
            ]);
        }

        return new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode']));
    }

    /**
     * Display the specified purchase.
     */
    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode']));
    }

    /**
     * Update the specified purchase.
     */
    public function update(Request $request, Purchase $purchase)
    {

        // $purchase = Purchase::find($id);
        // if (!$purchase) {
        //     return response()->json(['status' => false, 'message' => 'Purchase not found.'], 404);
        // }

        
        $data = $request->validate([
            'pur_date' => 'required|date',
            'pur_inv_barcode' => 'required|string|max:255',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'ven_inv_no' => 'nullable|string|max:255',
            'ven_inv_date' => 'nullable|date',
            'ven_inv_ref' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'discount_percent' => 'nullable|numeric|min:0',
            'discount_amt' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:paid,unpaid,overdue',
            'payment_mode_id' => 'required|exists:payment_modes,id',
            'transaction_type_id' => 'required|exists:transaction_types,id',

            // ✅ Details validation
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
        ]);

        // ✅ Update main purchase
        $purchase->update([
            'pur_date' => $data['pur_date'],
            'pur_inv_barcode' => $data['pur_inv_barcode'],
            'vendor_id' => $data['vendor_id'],
            'ven_inv_no' => $data['ven_inv_no'] ?? null,
            'ven_inv_date' => $data['ven_inv_date'] ?? null,
            'ven_inv_ref' => $data['ven_inv_ref'] ?? null,
            'description' => $data['description'] ?? null,
            'discount_percent' => $data['discount_percent'] ?? 0,
            'discount_amt' => $data['discount_amt'] ?? 0,
            'payment_status' => $data['payment_status'],
            'payment_mode_id' => $data['payment_mode_id'],
            'transaction_type_id' => $data['transaction_type_id'],
        ]);

        // ✅ Delete old details & reinsert
        $purchase->details()->delete();

        foreach ($data['details'] as $detail) {
            $purchase->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'unit_price' => $detail['unit_price'],
                'discAmount' => $detail['discAmount'] ?? 0,
                'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
            ]);
        }

        // ✅ Recalculate total
        $totalAmount = collect($data['details'])->sum(function ($detail) {
            return ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
        });
        $purchase->update(['inv_amount' => $totalAmount]);

        return new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode']));
    }

    /**
     * Remove the specified purchase.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->details()->delete();
        $purchase->delete();

        return response()->json([
            'status' => true,
            'message' => 'Purchase deleted successfully.'
        ]);
    }
}
