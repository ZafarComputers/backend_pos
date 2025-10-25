<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Helpers\TransactionHelper;

class PurchaseApiController extends Controller
{
    /**
     * Display all purchases with relationships.
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['vendor', 'details.product.category', 'paymentMode'])
            ->latest();

        if ($request->filled('payment_status')) {
            $status = strtolower($request->query('payment_status'));
            if (in_array($status, ['paid', 'unpaid', 'overdue'])) {
                $query->where('payment_status', $status);
            }
        }

        return response()->json([
            'status' => true,
            'data' => PurchaseResource::collection($query->get()),
        ]);
    }

    /**
     * Store a new Purchase (with transactions and details)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pur_date' => 'required|date',
            'pur_inv_barcode' => 'required|string|max:255|unique:purchases,pur_inv_barcode',
            'vendor_id' => 'required|exists:vendors,id',
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

        DB::beginTransaction();

        try {
            // ✅ Calculate total
            $totalAmount = collect($validated['details'])->sum(function ($item) {
                return ($item['qty'] * $item['unit_price']) - ($item['discAmount'] ?? 0);
            });

            // ✅ Create Purchase
            $purchase = Purchase::create([
                'pur_date' => $validated['pur_date'],
                'pur_inv_barcode' => $validated['pur_inv_barcode'],
                'vendor_id' => $validated['vendor_id'],
                'ven_inv_no' => $validated['ven_inv_no'] ?? null,
                'ven_inv_date' => $validated['ven_inv_date'] ?? null,
                'ven_inv_ref' => $validated['ven_inv_ref'] ?? null,
                'description' => $validated['description'] ?? null,
                'discount_percent' => $validated['discount_percent'] ?? 0,
                'discount_amt' => $validated['discount_amt'] ?? 0,
                'inv_amount' => $totalAmount,
                'payment_status' => $validated['payment_status'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'users_id' => Auth::id(),
            ]);

            // ✅ Add details
            foreach ($validated['details'] as $detail) {
                $purchase->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty' => $detail['qty'],
                    'unit_price' => $detail['unit_price'],
                    'discAmount' => $detail['discAmount'] ?? 0,
                    'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
                ]);
            }

            // ✅ Create double-entry transactions (same logic as PosApiController)
            $this->createPurchaseTransaction($purchase);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase stored successfully with related transactions.',
                'data' => new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode'])),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to store purchase: ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing purchase.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'pur_date' => 'required|date',
            'pur_inv_barcode' => 'required|string|max:255|unique:purchases,pur_inv_barcode,' . $purchase->id,
            'vendor_id' => 'required|exists:vendors,id',
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

        DB::beginTransaction();

        try {
            $totalAmount = collect($validated['details'])->sum(function ($item) {
                return ($item['qty'] * $item['unit_price']) - ($item['discAmount'] ?? 0);
            });

            $purchase->update([
                'pur_date' => $validated['pur_date'],
                'pur_inv_barcode' => $validated['pur_inv_barcode'],
                'vendor_id' => $validated['vendor_id'],
                'ven_inv_no' => $validated['ven_inv_no'] ?? null,
                'ven_inv_date' => $validated['ven_inv_date'] ?? null,
                'ven_inv_ref' => $validated['ven_inv_ref'] ?? null,
                'description' => $validated['description'] ?? null,
                'discount_percent' => $validated['discount_percent'] ?? 0,
                'discount_amt' => $validated['discount_amt'] ?? 0,
                'inv_amount' => $totalAmount,
                'payment_status' => $validated['payment_status'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'users_id' => Auth::id(),
            ]);

            // ✅ Refresh purchase details
            $purchase->details()->delete();
            foreach ($validated['details'] as $detail) {
                $purchase->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty' => $detail['qty'],
                    'unit_price' => $detail['unit_price'],
                    'discAmount' => $detail['discAmount'] ?? 0,
                    'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
                ]);
            }

            // ✅ Recreate transactions
            Transaction::where('invRef_id', $purchase->id)
                ->where('transaction_type_id', $purchase->transaction_type_id)
                ->delete();

            $this->createPurchaseTransaction($purchase);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase updated successfully.',
                'data' => new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode'])),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update purchase: ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show a single purchase.
     */
    public function show(Purchase $purchase)
    {
        return response()->json([
            'status' => true,
            'data' => new PurchaseResource($purchase->load(['vendor', 'details.product', 'paymentMode'])),
        ]);
    }

    /**
     * Delete a purchase and its transactions.
     */
    public function destroy(Purchase $purchase)
    {
        DB::beginTransaction();

        try {
            Transaction::where('invRef_id', $purchase->id)
                ->where('transaction_type_id', $purchase->transaction_type_id)
                ->delete();

            $purchase->details()->delete();
            $purchase->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase and related transactions deleted successfully.',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete purchase: ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle transaction creation (same logic as POS).
     */
    private function createPurchaseTransaction(Purchase $purchase)
    {
        $coaPurchase = 6; // Example COA ID for Purchases
        $coaCash = 3;     // COA ID for Cash
        $coaBank = 4;     // COA ID for Bank

        switch ($purchase->payment_mode_id) {
            case 1: // Cash Purchase
                TransactionHelper::createDoubleEntry(
                    $purchase->pur_date,
                    $purchase->id,
                    $purchase->transaction_type_id,
                    $coaPurchase,
                    $coaCash,
                    Auth::id(),
                    $purchase->description,
                    $purchase->inv_amount
                );
                break;

            case 2: // Bank Purchase
                TransactionHelper::createDoubleEntry(
                    $purchase->pur_date,
                    $purchase->id,
                    $purchase->transaction_type_id,
                    $coaPurchase,
                    $coaBank,
                    Auth::id(),
                    $purchase->description,
                    $purchase->inv_amount
                );
                break;

            case 3: // Credit Purchase
                TransactionHelper::createDoubleEntry(
                    $purchase->pur_date,
                    $purchase->id,
                    $purchase->transaction_type_id,
                    $coaPurchase,
                    $purchase->vendor_id,
                    Auth::id(),
                    $purchase->description,
                    $purchase->inv_amount
                );
                break;
        }
    }
}
