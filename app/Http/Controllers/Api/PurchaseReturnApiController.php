<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;
use App\Models\Transaction;
use App\Http\Resources\PurchaseReturnResource;

class PurchaseReturnApiController extends Controller
{
    /**
     * Display a listing of the purchase returns.
     */
    public function index()
    {
        $returns = PurchaseReturn::with(['vendor', 'user', 'details', 'transactions'])
            ->latest()
            ->paginate(20);

        return response()->json([
            'status' => true,
            'message' => 'Purchase returns retrieved successfully.',
            'data' => PurchaseReturnResource::collection($returns),
        ]);
    }

    /**
     * Store a newly created purchase return in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'pur_return_barcode' => 'required|string|unique:purchase_returns,pur_return_barcode',
            'return_inv_no' => 'nullable|string',
            'purchase_id' => 'nullable|exists:purchases,id',
            'reason' => 'nullable|string',
            'return_date' => 'required|date',
            'vendor_id' => 'required|exists:vendors,id',
            'users_id' => 'required|exists:users,id',
            'coas_id' => 'required|exists:coas,id', // Vendor Account
            'payment_mode_id' => 'required|in:1,2', // 1=Cash, 2=Bank
            'description' => 'nullable|string',
            'return_amount' => 'required|numeric|min:0.01',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Create Purchase Return record
            $purchaseReturn = PurchaseReturn::create([
                'return_inv_no' => $validated['return_inv_no'] ?? null,
                'purchase_id' => $validated['purchase_id'] ?? null,
                'reason' => $validated['reason'] ?? null,
                'return_date' => $validated['return_date'],
                'vendor_id' => $validated['vendor_id'],
                'users_id' => $validated['users_id'],
                'coas_id' => $validated['coas_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'transaction_type_id' => 3, // Purchase Return transaction type
                'description' => $validated['description'] ?? null,
                'return_amount' => $validated['return_amount'],
            ]);

            // ✅ Create related Purchase Return Details
            foreach ($validated['details'] as $detail) {
                PurchaseReturnDetail::create([
                    'purchase_return_id' => $purchaseReturn->id,
                    'product_id' => $detail['product_id'],
                    'qty' => $detail['qty'],
                    'unit_price' => $detail['unit_price'],
                    'subtotal' => $detail['qty'] * $detail['unit_price'],
                ]);
            }

            // ✅ Determine COA references
            $vendorCoaId = $validated['coas_id'];
            $paymentModeCoaId = $validated['payment_mode_id'] == 1 ? 3 : 7; // Cash=3, Bank=7

            // 🔹 Reverse Entries compared to Purchase
            // CREDIT: Stock/Inventory decreases
            Transaction::create([
                'date' => $validated['return_date'],
                'transaction_type_id' => 3, // e.g. Purchase Return Type ID
                'invRef_id' => $purchaseReturn->id,
                'coas_id' => 5, // Stock COA (example)
                'coaRef_id' => $vendorCoaId,
                'description' => $validated['description'] ?? 'Purchase Return Credit Entry',
                'debit' => 0,
                'credit' => $validated['return_amount'],
                'users_id' => $validated['users_id'],
            ]);

            // DEBIT: Vendor/Payable decreases
            Transaction::create([
                'date' => $validated['return_date'],
                'transaction_type_id' => 3,
                'invRef_id' => $purchaseReturn->id,
                'coas_id' => $vendorCoaId,
                'coaRef_id' => 5, // Stock
                'description' => $validated['description'] ?? 'Purchase Return Debit Entry',
                'debit' => $validated['return_amount'],
                'credit' => 0,
                'users_id' => $validated['users_id'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase return created successfully.',
                'data' => new PurchaseReturnResource(
                    $purchaseReturn->load(['vendor', 'user', 'details', 'transactions'])
                ),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to store purchase return: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing purchase return.
     */
    public function update(Request $request, $id)
    {
        $purchaseReturn = PurchaseReturn::findOrFail($id);

        $validated = $request->validate([
            // 'pur_return_barcode' => 'required|string|unique:purchase_returns,pur_return_barcode,' . $purchaseReturn->id,
            'return_inv_no' => 'nullable|string',
            'purchase_id' => 'nullable|exists:purchases,id',
            'reason' => 'nullable|string',
            'return_date' => 'required|date',
            'vendor_id' => 'required|exists:vendors,id',
            'users_id' => 'required|exists:users,id',
            'coas_id' => 'required|exists:coas,id',
            'payment_mode_id' => 'required|in:1,2',
            'description' => 'nullable|string',
            'return_amount' => 'required|numeric|min:0.01',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.unit_price' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Update main Purchase Return record
            $purchaseReturn->update([
                'return_inv_no' => $validated['return_inv_no'] ?? null,
                'purchase_id' => $validated['purchase_id'] ?? null,
                'reason' => $validated['reason'] ?? null, // ✅ now saving reason
                'return_date' => $validated['return_date'],
                'vendor_id' => $validated['vendor_id'],
                'users_id' => $validated['users_id'],
                'coas_id' => $validated['coas_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'transaction_type_id' => 3, // ✅ ensure consistency
                'description' => $validated['description'] ?? null,
                'total_amount' => $validated['return_amount'], // ✅ rename for consistency
            ]);

            // ✅ Remove old details
            PurchaseReturnDetail::where('purchase_return_id', $purchaseReturn->id)->delete();

            // ✅ Insert updated details
            foreach ($validated['details'] as $detail) {
                PurchaseReturnDetail::create([
                    'purchase_return_id' => $purchaseReturn->id,
                    'product_id' => $detail['product_id'],
                    'qty' => $detail['qty'],
                    'unit_price' => $detail['unit_price'],
                    'subtotal' => $detail['qty'] * $detail['unit_price'],
                ]);
            }

            // ✅ Delete previous transactions
            Transaction::where('invRef_id', $purchaseReturn->id)
                ->where('transaction_type_id', 3)
                ->delete();

            // ✅ Recreate transactions (same as store)
            $vendorCoaId = $validated['coas_id'];
            $paymentModeCoaId = $validated['payment_mode_id'] == 1 ? 3 : 7;

            // CREDIT: Stock/Inventory decreases
            Transaction::create([
                'date' => $validated['return_date'],
                'transaction_type_id' => 3,
                'invRef_id' => $purchaseReturn->id,
                'coas_id' => 5,
                'coaRef_id' => $vendorCoaId,
                'description' => $validated['description'] ?? 'Purchase Return Credit Entry (Updated)',
                'debit' => 0,
                'credit' => $validated['return_amount'],
                'users_id' => $validated['users_id'],
            ]);

            // DEBIT: Vendor/Payable decreases
            Transaction::create([
                'date' => $validated['return_date'],
                'transaction_type_id' => 3,
                'invRef_id' => $purchaseReturn->id,
                'coas_id' => $vendorCoaId,
                'coaRef_id' => 5,
                'description' => $validated['description'] ?? 'Purchase Return Debit Entry (Updated)',
                'debit' => $validated['return_amount'],
                'credit' => 0,
                'users_id' => $validated['users_id'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase return updated successfully.',
                'data' => new PurchaseReturnResource(
                    $purchaseReturn->load(['vendor', 'user', 'details', 'transactions'])
                ),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to update purchase return: ' . $e->getMessage(),
            ], 500);
        }
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
     * Remove a purchase return from storage.
     */
    public function destroy($id)
    {
        $purchaseReturn = PurchaseReturn::findOrFail($id);

        DB::beginTransaction();

        try {
            PurchaseReturnDetail::where('purchase_return_id', $purchaseReturn->id)->delete();
            Transaction::where('invRef_id', $purchaseReturn->id)
                ->where('transaction_type_id', 3)
                ->delete();

            $purchaseReturn->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Purchase return deleted successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete purchase return: ' . $e->getMessage(),
            ], 500);
        }
    }
}
