<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\PosReturn;
use App\Models\Product;

use App\Http\Resources\PosReturnResource;

class PosReturnApiController extends Controller
{
    /**
     * Display a listing of the POS Returns.
     */
    public function index()
    {
        $posReturns = PosReturn::with(['customer', 'employee', 'details.product'])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'POS Return list retrieved successfully.',
            'data' => PosReturnResource::collection($posReturns),
        ]);
    }

    /**
     * Store a newly created POS Return.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $this->validatePosReturn($request);

            $posReturn = PosReturn::create([
                'invRet_date' => $validated['invRet_date'],
                'customer_id' => $validated['customer_id'],
                'employee_id' => $validated['employee_id'],
                'transaction_type_id' => $validated['transaction_type_id'] ?? 3, // default Return
                'payment_mode_id' => $validated['payment_mode_id'],
                'tax' => $validated['tax'] ?? 0,
                'discPer' => $validated['discPer'] ?? 0,
                'discAmount' => $validated['discAmount'] ?? 0,
                'return_inv_amount' => $validated['return_inv_amount'],
                'paid' => $validated['paid'] ?? 0,
                'description' => $validated['description'] ?? null,
            ]);

            $this->saveDetailsAndAdjustStock($posReturn, $validated['details']);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS Return created successfully.',
                'data' => new PosReturnResource($posReturn->load(['details.product', 'customer', 'employee'])),
            ], 201);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create POS Return.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified POS Return.
     */
    public function show(PosReturn $posReturn)
    {
        $posReturn->load(['details.product', 'customer', 'employee']);

        return response()->json([
            'status' => true,
            'message' => 'POS Return details retrieved successfully.',
            'data' => new PosReturnResource($posReturn),
        ]);
    }

    /**
     * Update the specified POS Return.
     */
    public function update(Request $request, PosReturn $posReturn)
    {
        DB::beginTransaction();

        try {
            $validated = $this->validatePosReturn($request);

            // Reverse old stock adjustments
            foreach ($posReturn->details as $oldDetail) {
                $product = Product::find($oldDetail->product_id);
                if ($product) {
                    $product->increment('stock_out_quantity', $oldDetail->qty);
                    $product->decrement('in_stock_quantity', $oldDetail->qty);
                }
            }

            // Update main record
            $posReturn->update([
                'invRet_date' => $validated['invRet_date'],
                'customer_id' => $validated['customer_id'],
                'employee_id' => $validated['employee_id'],
                'transaction_type_id' => $validated['transaction_type_id'] ?? $posReturn->transaction_type_id,
                'payment_mode_id' => $validated['payment_mode_id'],
                'tax' => $validated['tax'] ?? 0,
                'discPer' => $validated['discPer'] ?? 0,
                'discAmount' => $validated['discAmount'] ?? 0,
                'return_inv_amount' => $validated['return_inv_amount'],
                'paid' => $validated['paid'] ?? 0,
                'description' => $validated['description'] ?? null,
            ]);

            // Delete old details and save new ones
            $posReturn->details()->delete();
            $this->saveDetailsAndAdjustStock($posReturn, $validated['details']);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS Return updated successfully.',
                'data' => new PosReturnResource($posReturn->load(['details.product', 'customer', 'employee'])),
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update POS Return.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified POS Return.
     */
    public function destroy(PosReturn $posReturn)
    {
        DB::beginTransaction();

        try {
            // Reverse stock
            foreach ($posReturn->details as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->increment('stock_out_quantity', $detail->qty);
                    $product->decrement('in_stock_quantity', $detail->qty);
                }
            }

            $posReturn->details()->delete();
            $posReturn->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS Return deleted successfully.',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete POS Return.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Validate POS Return request.
     */
    private function validatePosReturn(Request $request)
    {
        return $request->validate([
            'invRet_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'employee_id' => 'required|exists:employees,id',
            'transaction_type_id' => 'nullable|exists:transaction_types,id',
            'payment_mode_id' => 'required|exists:payment_modes,id',

            'tax' => 'nullable|numeric|min:0',
            'discPer' => 'nullable|numeric|min:0',
            'discAmount' => 'nullable|numeric|min:0',
            'return_inv_amount' => 'required|numeric|min:0',
            'paid' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:255',

            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.return_unit_price' => 'required|numeric|min:0',
            'details.*.discPer' => 'nullable|numeric|min:0',
            'details.*.discAmount' => 'nullable|numeric|min:0',
        ]);
    }

    /**
     * Save POS Return details and adjust stock.
     */
    private function saveDetailsAndAdjustStock(PosReturn $posReturn, array $details)
    {
        foreach ($details as $detail) {
            $posReturn->details()->create([
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
                'return_unit_price' => $detail['return_unit_price'],
                'discPer' => $detail['discPer'] ?? 0,
                'discAmount' => $detail['discAmount'] ?? 0,
            ]);

            $product = Product::find($detail['product_id']);
            if ($product) {
                $product->decrement('stock_out_quantity', $detail['qty']);
                $product->increment('in_stock_quantity', $detail['qty']);
            }
        }
    }
}
