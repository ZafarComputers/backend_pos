<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Helpers\TransactionHelper;


class PurchaseApiController extends Controller
{
    /**
     * Display a listing of purchases.
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['vendor', 'details.product', 'details.product.category', 'paymentMode'])->latest();

            //    $pos = Pos::with('details')->latest()->get();
 

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
        DB::beginTransaction();

        try {
            // ✅ Step 1: Validate and store Purchase (your existing validation)
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
                'details' => 'required|array|min:1',
                'details.*.product_id' => 'required|exists:products,id',
                'details.*.qty' => 'required|numeric|min:1',
                'details.*.unit_price' => 'required|numeric|min:0',
                'details.*.discAmount' => 'nullable|numeric|min:0',
            ]);

            // ✅ Step 2: Calculate total amount
            $totalAmount = collect($data['details'])->sum(fn($d) =>
                ($d['qty'] * $d['unit_price']) - ($d['discAmount'] ?? 0)
            );

            // ✅ Step 3: Create Purchase
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

            // ✅ Step 4: Store Details
            foreach ($data['details'] as $detail) {
                $purchase->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty' => $detail['qty'],
                    'unit_price' => $detail['unit_price'],
                    'discAmount' => $detail['discAmount'] ?? 0,
                    'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
                ]);
            }

            // Add double-entry transactions
            if ($purchase->payment_mode_id == 1) {
                // Cash purchase
                TransactionHelper::createDoubleEntry(
                    $purchase->pur_date,
                    $purchase->id,
                    $purchase->transaction_type_id,
                    6, // coa_id for Purchases (example)
                    3, // coa_id for Cash
                    auth()->id(),
                    $purchase->description,
                    $purchase->inv_amount
                );
            } elseif ($purchase->payment_mode_id == 2) {
                // Bank purchase
                TransactionHelper::createDoubleEntry(
                    $purchase->pur_date,
                    $purchase->id,
                    $purchase->transaction_type_id,
                    6, // Purchases
                    4, // Bank
                    auth()->id(),
                    $purchase->description,
                    $purchase->inv_amount
                );
            } elseif ($purchase->payment_mode_id == 3) {
                // Credit purchase
                TransactionHelper::createDoubleEntry(
                    $purchase->pur_date,
                    $purchase->id,
                    $purchase->transaction_type_id,
                    6, // Purchases
                    $purchase->vendor_id, // Vendor as COA reference
                    auth()->id(),
                    $purchase->description,
                    $purchase->inv_amount
                );
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase and related transactions stored successfully.',
                'data' => $purchase->load('details', 'vendor'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to store purchase: ' . $e->getMessage(),
            ], 500);
        }
    }


    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'pur_date' => 'required|date',
    //         'pur_inv_barcode' => 'required|string|max:255',
    //         'vendor_id' => 'required|integer|exists:vendors,id',
    //         'ven_inv_no' => 'nullable|string|max:255',
    //         'ven_inv_date' => 'nullable|date',
    //         'ven_inv_ref' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'discount_percent' => 'nullable|numeric|min:0',
    //         'discount_amt' => 'nullable|numeric|min:0',
    //         'payment_status' => 'required|in:paid,unpaid,overdue',

    //         // ✅ Must be provided
    //         'payment_mode_id' => 'required|exists:payment_modes,id',
    //         'transaction_type_id' => 'required|exists:transaction_types,id',

    //         // ✅ Details validation
    //         'details' => 'required|array|min:1',
    //         'details.*.product_id' => 'required|exists:products,id',
    //         'details.*.qty' => 'required|numeric|min:1',
    //         'details.*.unit_price' => 'required|numeric|min:0',
    //         'details.*.discAmount' => 'nullable|numeric|min:0',
    //     ]);

    //     // ✅ Calculate total amount
    //     $totalAmount = collect($data['details'])->sum(function ($detail) {
    //         return ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
    //     });

    //     // ✅ Create Purchase
    //     $purchase = Purchase::create([
    //         'pur_date' => $data['pur_date'],
    //         'pur_inv_barcode' => $data['pur_inv_barcode'],
    //         'vendor_id' => $data['vendor_id'],
    //         'ven_inv_no' => $data['ven_inv_no'] ?? null,
    //         'ven_inv_date' => $data['ven_inv_date'] ?? null,
    //         'ven_inv_ref' => $data['ven_inv_ref'] ?? null,
    //         'description' => $data['description'] ?? null,
    //         'discount_percent' => $data['discount_percent'] ?? 0,
    //         'discount_amt' => $data['discount_amt'] ?? 0,
    //         'inv_amount' => $totalAmount,
    //         'payment_status' => $data['payment_status'],
    //         'transaction_type_id' => $data['transaction_type_id'],
    //         'payment_mode_id' => $data['payment_mode_id'],
    //     ]);

    //     // ✅ Save details
    //     foreach ($data['details'] as $detail) {
    //         $purchase->details()->create([
    //             'product_id' => $detail['product_id'],
    //             'qty' => $detail['qty'],
    //             'unit_price' => $detail['unit_price'],
    //             'discAmount' => $detail['discAmount'] ?? 0,
    //             'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
    //         ]);
    //     }

    //     return new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode']));
    // }

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
        $data = $request->validate([
            'pur_date' => 'required|date',
            'description' => 'nullable|string',
            'inv_amount' => 'required|numeric|min:0',
            'payment_mode_id' => 'required|exists:payment_modes,id',
        ]);

        // ✅ Update the purchase
        $purchase->update($data);

        // ✅ Delete old transactions for this purchase
        Transaction::where('invRef_id', $purchase->id)
            ->where('transaction_types_id', $purchase->transaction_type_id)
            ->delete();

        // ✅ Recreate double entries
        if ($purchase->payment_mode_id == 1) {
            // Cash Purchase
            TransactionHelper::createDoubleEntry(
                $purchase->pur_date,
                $purchase->id,
                $purchase->transaction_type_id,
                6, // Purchases
                3, // Cash
                auth()->id(),
                $purchase->description,
                $purchase->inv_amount
            );
        } elseif ($purchase->payment_mode_id == 2) {
            // Bank Purchase
            TransactionHelper::createDoubleEntry(
                $purchase->pur_date,
                $purchase->id,
                $purchase->transaction_type_id,
                6, // Purchases
                4, // Bank
                auth()->id(),
                $purchase->description,
                $purchase->inv_amount
            );
        } elseif ($purchase->payment_mode_id == 3) {
            // Credit Purchase
            TransactionHelper::createDoubleEntry(
                $purchase->pur_date,
                $purchase->id,
                $purchase->transaction_type_id,
                6, // Purchases
                $purchase->vendor_id, // Vendor
                auth()->id(),
                $purchase->description,
                $purchase->inv_amount
            );
        }

        return new PurchaseResource($purchase->load(['transactions']));
    }


    /**
     * Remove the specified purchase.
     */
    public function destroy(Purchase $purchase)
    {
        // Delete related transactions
        Transaction::where('invRef_id', $purchase->id)
            ->where('transaction_types_id', $purchase->transaction_type_id)
            ->delete();

        // Delete purchase
        $purchase->delete();

        return response()->json([
            'status' => true,
            'message' => 'Purchase and related transactions deleted successfully.'
        ]);
    }

}