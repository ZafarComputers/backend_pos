<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;
use App\Http\Resources\PurchaseReturnResource;
use Illuminate\Http\Request;

class PurchaseReturnApiController extends Controller
{
    /**
     * Get all purchase returns with relations
     */
    public function index(Request $request)
    {
        $purchaseReturns = PurchaseReturn::with(['vendor', 'purchase', 'details.product'])->get();

        return response()->json($purchaseReturns);
    }

    /**
     * Store a new purchase return
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_id'   => 'required|exists:purchases,id',
            'vendor_id'     => 'required|exists:vendors,id',
            'return_inv_no' => 'required|string|unique:purchase_returns,return_inv_no',
            'return_date'   => 'required|date',
            'reason'        => 'nullable|string',
            'total_amount'  => 'required|numeric',
            'details'       => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'   => 'required|integer|min:1',
            'details.*.unit_price'      => 'required|numeric|min:0',
            // 'details.*.subtotal'   => 'required|numeric|min:0',
        ]);

        // Create Purchase Return
        $purchaseReturn = PurchaseReturn::create([
            'purchase_id'   => $validated['purchase_id'],
            'vendor_id'     => $validated['vendor_id'],
            'return_inv_no' => $validated['return_inv_no'],
            'return_date'   => $validated['return_date'],
            'reason'        => $validated['reason'] ?? null,
            'total_amount'  => $validated['total_amount'],
        ]);

        // Save Purchase Return Details
        foreach ($validated['details'] as $detail) {
            PurchaseReturnDetail::create([
                'purchase_return_id' => $purchaseReturn->id,
                'product_id'         => $detail['product_id'],
                'qty'                => $detail['qty'],
                'unit_price'              => $detail['unit_price'],
                // 'subtotal'           => $detail['subtotal'],
            ]);
        }

        return response()->json([
            'message' => 'Purchase Return created successfully',
            'data'    => $purchaseReturn->load('details')
        ], 201);
    }

    
    /**
     * Show single purchase return
     */
    public function show(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->load(['vendor', 'purchase', 'details.product']);

        return response()->json($purchaseReturn);
    }

    /**
     * Update purchase return
     */
    public function update(Request $request, PurchaseReturn $purchaseReturn)
    {
        $validated = $request->validate([
            'purchase_id'   => 'required|exists:purchases,id',
            'vendor_id'     => 'required|exists:vendors,id',
            'return_inv_no' => 'required|string|unique:purchase_returns,return_inv_no,' . $purchaseReturn->id,
            'return_date'   => 'required|date',
            'reason'        => 'nullable|string',
            'total_amount'  => 'required|numeric',
            'details'       => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'   => 'required|integer|min:1',
            'details.*.unit_price'      => 'required|numeric|min:0',
            // 'details.*.subtotal'   => 'required|numeric|min:0',
        ]);

        // Update Purchase Return
        $purchaseReturn->update([
            'purchase_id'   => $validated['purchase_id'],
            'vendor_id'     => $validated['vendor_id'],
            'return_inv_no' => $validated['return_inv_no'],
            'return_date'   => $validated['return_date'],
            'reason'        => $validated['reason'] ?? null,
            'total_amount'  => $validated['total_amount'],
        ]);

        // Delete old details first
        $purchaseReturn->details()->delete();

        // Insert new details
        foreach ($validated['details'] as $detail) {
            PurchaseReturnDetail::create([
                'purchase_return_id' => $purchaseReturn->id,
                'product_id'         => $detail['product_id'],
                'qty'           => $detail['qty'],
                'unit_price'              => $detail['unit_price'],
                // 'subtotal'           => $detail['subtotal'],
            ]);
        }

        return response()->json([
            'message' => 'Purchase Return updated successfully',
            'data'    => $purchaseReturn->load('details')
        ], 200);
    }


    /**
     * Delete purchase return
     */
    public function destroy(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->details()->delete();
        $purchaseReturn->delete();

        return response()->json([
            'message' => 'Purchase Return deleted successfully',
        ]);
    }
}
