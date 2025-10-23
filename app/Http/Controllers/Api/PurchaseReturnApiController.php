<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;
use App\Models\Transaction;
use App\Http\Resources\PurchaseReturnResource;
use Illuminate\Support\Facades\Auth;

class PurchaseReturnApiController extends Controller
{
    /**
     * Get all purchase returns with relations
     */
    public function index(Request $request)
    {
        $purchaseReturns = PurchaseReturn::with(['vendor', 'purchase', 'details.product'])->get();
        return PurchaseReturnResource::collection($purchaseReturns);
    }

    /**
     * Store a new purchase return
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'purchase_id' => 'nullable|exists:purchases,id',
            'return_date' => 'required|date',
            'reason' => 'nullable|string',
            'discount_percent' => 'nullable|numeric|min:0',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
            'payment_mode_id' => 'required|exists:payment_modes,id', // numeric id expected
        ]);

        // Calculate total return amount
        $return_amount = 0;
        foreach ($validated['details'] as $detail) {
            $lineAmount = ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
            $return_amount += $lineAmount;
        }

        // Generate invoice number
        $returnNo = 'PR-' . str_pad(PurchaseReturn::count() + 1, 4, '0', STR_PAD_LEFT);

        // Create Purchase Return (persist payment_mode_id too)
        $purchaseReturn = PurchaseReturn::create([
            'vendor_id' => $validated['vendor_id'],
            'purchase_id' => $validated['purchase_id'] ?? null,
            'return_inv_no' => $returnNo,
            'return_date' => $validated['return_date'],
            'reason' => $validated['reason'] ?? null,
            'discount_percent' => $validated['discount_percent'] ?? 0,
            'return_amount' => $return_amount,
            'payment_mode_id' => $validated['payment_mode_id'], // store payment mode
        ]);

        // Create related details
        foreach ($validated['details'] as $detail) {
            $purchaseReturn->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'unit_price' => $detail['unit_price'],
                'discAmount' => $detail['discAmount'] ?? 0,
                'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
            ]);
        }

        // Create double-entry transactions
        $userId = Auth::id() ?? 1;
        $transTypeId = 3; // adjust if your TransactionType ids differ

        // determine coa ids based on payment_mode_id (integers)
        $coaId = 3; // Return / Inventory COA (example)
        $coaRefId = match ($validated['payment_mode_id']) {
            1 => 6, // cash => COA id 6 (example)
            2 => 7, // bank => COA id 7 (example)
            3 => $validated['vendor_id'], // credit => vendor's COA (using vendor id as COA ref)
            default => 6, // fallback to cash
        };

        // 1st Entry (Debit)
        Transaction::create([
            'date' => $validated['return_date'],
            'invRef_id' => $purchaseReturn->id,
            'transaction_types_id' => $transTypeId,
            'coas_id' => $coaId,
            'coaRef_id' => $coaRefId,
            'users_id' => $userId,
            'description' => 'Purchase Return: ' . $returnNo,
            'debit' => $return_amount,
            'credit' => 0,
        ]);

        // 2nd Entry (Credit)
        Transaction::create([
            'date' => $validated['return_date'],
            'invRef_id' => $purchaseReturn->id,
            'transaction_types_id' => $transTypeId,
            'coas_id' => $coaRefId,
            'coaRef_id' => $coaId,
            'users_id' => $userId,
            'description' => 'Purchase Return: ' . $returnNo,
            'debit' => 0,
            'credit' => $return_amount,
        ]);

        return new PurchaseReturnResource($purchaseReturn->load(['vendor', 'details.product']));
    }

    /**
     * Show single purchase return
     */
    public function show(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->load(['vendor', 'purchase', 'details.product']);
        return new PurchaseReturnResource($purchaseReturn);
    }

    /**
     * Update purchase return
     */
    public function update(Request $request, PurchaseReturn $purchaseReturn)
    {
        $data = $request->validate([
            'vendor_id' => 'sometimes|exists:vendors,id',
            'purchase_id' => 'nullable|exists:purchases,id',
            'return_date' => 'sometimes|date',
            'reason' => 'nullable|string',
            'details' => 'sometimes|array|min:1',
            'details.*.product_id' => 'required_with:details|exists:products,id',
            'details.*.qty' => 'required_with:details|numeric|min:1',
            'details.*.unit_price' => 'required_with:details|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
            'payment_mode_id' => 'sometimes|exists:payment_modes,id',
        ]);

        // Delete old transactions for this return
        Transaction::where('invRef_id', $purchaseReturn->id)->delete();

        // Update main record (include payment_mode_id if provided)
        $purchaseReturn->update($data);

        // Recalculate total return amount and replace details (if provided)
        $return_amount = $purchaseReturn->return_amount ?? 0;
        if (!empty($data['details'])) {
            $purchaseReturn->details()->delete();
            $return_amount = 0;
            foreach ($data['details'] as $item) {
                $line = ($item['qty'] * $item['unit_price']) - ($item['discAmount'] ?? 0);
                $return_amount += $line;
                $purchaseReturn->details()->create([
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['unit_price'],
                    'discAmount' => $item['discAmount'] ?? 0,
                    'amount' => $line,
                ]);
            }

            // Update the calculated return amount on the model
            $purchaseReturn->update(['return_amount' => $return_amount]);
        } else {
            // If details not provided, keep existing return_amount (or recalc from details if you prefer)
            $return_amount = $purchaseReturn->return_amount ?? 0;
        }

        // Recreate transactions using payment_mode_id from request or from model
        $userId = Auth::id() ?? 1;
        $transTypeId = 3;
        $coaId = 3;
        $paymentModeId = $data['payment_mode_id'] ?? $purchaseReturn->payment_mode_id ?? 1;

        $coaRefId = match ($paymentModeId) {
            1 => 6,
            2 => 7,
            3 => $purchaseReturn->vendor_id,
            default => 6,
        };

        Transaction::create([
            'date' => $data['return_date'] ?? $purchaseReturn->return_date,
            'invRef_id' => $purchaseReturn->id,
            'transaction_types_id' => $transTypeId,
            'coas_id' => $coaId,
            'coaRef_id' => $coaRefId,
            'users_id' => $userId,
            'description' => 'Updated Purchase Return: ' . $purchaseReturn->return_inv_no,
            'debit' => $return_amount,
            'credit' => 0,
        ]);

        Transaction::create([
            'date' => $data['return_date'] ?? $purchaseReturn->return_date,
            'invRef_id' => $purchaseReturn->id,
            'transaction_types_id' => $transTypeId,
            'coas_id' => $coaRefId,
            'coaRef_id' => $coaId,
            'users_id' => $userId,
            'description' => 'Updated Purchase Return: ' . $purchaseReturn->return_inv_no,
            'debit' => 0,
            'credit' => $return_amount,
        ]);

        return new PurchaseReturnResource($purchaseReturn->load(['vendor', 'purchase', 'details.product']));
    }

    /**
     * Delete purchase return
     */
    public function destroy(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->details()->delete();
        Transaction::where('invRef_id', $purchaseReturn->id)->delete();
        $purchaseReturn->delete();

        return response()->json(['message' => 'Purchase Return deleted successfully']);
    }
}