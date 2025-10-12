<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;

use App\Http\Resources\PurchaseReturnResource;

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
        ]);

        // ✅ Calculate total amount
        $return_amount = 0;
        foreach ($validated['details'] as $detail) {
            $lineAmount = ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0);
            $return_amount += $lineAmount;
        }

        // ✅ Auto-generate return invoice number
        $returnNo = 'PR-' . str_pad(PurchaseReturn::count() + 1, 4, '0', STR_PAD_LEFT);

        // ✅ Create the Purchase Return
        $purchaseReturn = PurchaseReturn::create([
            'vendor_id' => $validated['vendor_id'],
            'purchase_id' => $validated['purchase_id'] ?? null,
            'return_inv_no' => $returnNo,
            'return_date' => $validated['return_date'],
            'reason' => $validated['reason'] ?? null,
            'discount_percent' => $validated['discount_percent'] ?? 0,
            'return_amount' => $return_amount,
        ]);

        // ✅ Create related details
        foreach ($validated['details'] as $detail) {
            $purchaseReturn->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'unit_price' => $detail['unit_price'],
                'discAmount' => $detail['discAmount'] ?? 0,
                'amount' => ($detail['qty'] * $detail['unit_price']) - ($detail['discAmount'] ?? 0),
            ]);
        }

        // ✅ Return using resource
        return new PurchaseReturnResource($purchaseReturn->load(['vendor', 'details.product']));
    }


    public function show(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->load(['vendor', 'purchase', 'details.product']);

        return new PurchaseReturnResource($purchaseReturn);
    }



    public function update(Request $request, PurchaseReturn $purchaseReturn)
    {
        // 🟩 Step 1: Validate incoming data
        $data = $request->validate([
            'vendor_id'     => 'sometimes|exists:vendors,id',
            'purchase_id'   => 'sometimes|exists:purchases,id',
            'return_date'   => 'sometimes|date',
            'description'   => 'nullable|string',
            'details'       => 'sometimes|array|min:1',
            'details.*.id'  => 'sometimes|exists:purchase_return_details,id',
            'details.*.product_id' => 'required_with:details|exists:products,id',
            'details.*.qty'        => 'required_with:details|numeric|min:1',
            'details.*.unit_price' => 'required_with:details|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
        ]);

        // 🟩 Step 2: Update main purchase return record
        $purchaseReturn->update($data);

        // 🟩 Step 3: Update return details (if provided)
        if (!empty($data['details'])) {
            // Delete existing details if you want to replace them
            $purchaseReturn->details()->delete();

            $totalAmount = 0;
            foreach ($data['details'] as $item) {
                $lineAmount = ($item['qty'] * $item['unit_price']) - ($item['discAmount'] ?? 0);
                $totalAmount += $lineAmount;

                $purchaseReturn->details()->create($item);
            }

            // Update total return amount
            $purchaseReturn->update([
                'total_return' => number_format($totalAmount, 2, '.', ''),
            ]);
        }

        // 🟩 Step 4: Return updated resource with all relations loaded
        return new PurchaseReturnResource(
            $purchaseReturn->load(['vendor', 'purchase', 'details.product'])
        );
    
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
