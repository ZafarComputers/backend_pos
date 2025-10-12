<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pos;
use App\Models\PosDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PosResource;
use App\Http\Resources\PosNoDtlResource;
use Illuminate\Support\Facades\Validator;

// use App\Http\Resources\PosDetailResource;


class PosApiController extends Controller
{
    /**
     * Display a listing of the POS.
     */
    public function index()
    {
        $pos = Pos::with(['details'])->latest()->get();
        return PosNoDtlResource::collection($pos);
    }

    /**
     * Store a newly created POS in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'       => 'required|date',
            'customer_id'    => 'required|exists:customers,id',
            'tax'            => 'nullable|numeric|min:0',
            'discPer'        => 'nullable|numeric|min:0',
            'discAmount'     => 'nullable|numeric|min:0',
            // inv_amount will be calculated from details; keep it optional or remove if you want
            'inv_amount'     => 'nullable|numeric|min:0',
            // make paid optional
            'paid'           => 'nullable|numeric|min:0',
            'details'        => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Calculate total from details (before discounts/tax if needed)
            $subtotal = collect($request->details)
                ->sum(fn($item) => $item['qty'] * $item['sale_price']);

            // apply discounts/tax logic here if necessary to compute final amount
            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;

            // final invoice amount (simple example: subtotal - discount + tax)
            $finalAmount = $subtotal - $discAmount + $tax;

            // use provided paid or default to 0
            $paid = $request->filled('paid') ? (float) $request->paid : 0.0;

            // determine payment status
            $payment_status = $paid >= $finalAmount
                ? 'Paid'
                : ($paid <= 0 ? 'Unpaid' : 'Partial');

            // create POS
            $pos = Pos::create([
                'inv_date'       => $request->inv_date,
                'customer_id'    => $request->customer_id,
                'tax'            => $tax,
                'discPer'        => $request->discPer ?? 0,
                'discAmount'     => $discAmount,
                'inv_amount'     => $finalAmount,
                'paid'           => $paid,
                'payment_status' => $payment_status,
            ]);

            // create details (pos_id assigned via relation)
            foreach ($request->details as $detail) {
                $pos->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);
            }

            DB::commit();

            $pos->load(['details.product', 'customer']);

            return response()->json([
                'status'  => true,
                'message' => 'POS created successfully.',
                'data'    => new PosResource($pos),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create POS.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified POS.
     */
    public function show($id)
    {
        $pos = Pos::with(['customer', 'details'])
                ->findOrFail($id);

        return new PosResource($pos);
    }
   


    /**
     * Update the specified POS in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'inv_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'tax' => 'numeric|min:0',
            'discPer' => 'numeric|min:0',
            'discAmount' => 'numeric|min:0',
            'inv_amount' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $pos = Pos::findOrFail($id);

            // Compute total
            $total_amount = collect($request->details)
                ->sum(fn($item) => $item['qty'] * $item['sale_price']);

            // Update main POS record
            $pos->update([
                'inv_date'       => $request->inv_date,
                'customer_id'    => $request->customer_id,
                'tax'            => $request->tax,
                'discPer'        => $request->discPer,
                'discAmount'     => $request->discAmount,
                'inv_amount'     => $request->inv_amount,
                'paid'           => $request->paid,
            ]);

            // Delete old details and re-insert updated ones
            $pos->details()->delete();

            foreach ($request->details as $detail) {
                PosDetail::create([
                    'pos_id'     => $pos->id,
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);
            }

            DB::commit();

            // Reload relations before returning
            $pos->load(['details.product', 'customer']);

            return response()->json([
                'status'  => true,
                'message' => 'POS updated successfully.',
                'data'    => new PosResource($pos)
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to update POS.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified POS from storage.
     */
    public function destroy(Pos $po)
    {
        try {
            $po->details()->delete();
            $po->delete();
            return response()->json(['message' => 'POS deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
