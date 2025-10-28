<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// Resources
use App\Http\Resources\PosResource;

// Models
use App\Models\Pos;
use App\Models\Product;

class PosBridalApiController extends Controller
{
    /**
     * Display a listing of the POS records.
     */
    public function index()
    {
        $pos = Pos::with(['customer', 'employee', 'details.product', 'extras', 'paymentMode', 'transactionType'])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'POS list retrieved successfully.',
            'data' => PosResource::collection($pos),
        ]);
    }

    /**
     * Store a newly created POS.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'             => 'required|date',
            'customer_id'          => 'required|exists:customers,id',
            'employee_id'          => 'required|exists:employees,id',
            'description'          => 'nullable|string',
            'inv_amount'           => 'required|numeric|min:0',
            'paid'                 => 'required|numeric|min:0',
            'tax'                  => 'required|numeric|min:0',
            'discPer'              => 'required|numeric|min:0|max:100',
            'discAmount'           => 'required|numeric|min:0',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'transaction_type_id'  => 'required|exists:transaction_types,id',
            'details'              => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
            'extras'               => 'nullable|array',
            'extras.*.title'       => 'required_with:extras|string|max:255',
            'extras.*.value'       => 'nullable|string|max:255',
            'extras.*.amount'      => 'required_with:extras|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $finalAmount = $request->inv_amount;
            $paid = (float) $request->paid;

            $payment_status = match (true) {
                $paid >= $finalAmount => 'Paid',
                $paid <= 0 => 'Unpaid',
                default => 'Partial',
            };

            // Create POS
            $pos = Pos::create([
                'inv_date'            => $request->inv_date,
                'customer_id'         => $request->customer_id,
                'employee_id'         => $request->employee_id,
                'description'         => $request->description,
                'tax'                 => $request->tax,
                'discPer'             => $request->discPer,
                'discAmount'          => $request->discAmount,
                'inv_amount'          => $finalAmount,
                'paid'                => $paid,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id,
                'payment_status'      => $payment_status,
            ]);

            // Create Details
            foreach ($request->details as $detail) {
                $pos->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);

                $product = Product::find($detail['product_id']);
                if ($product) {
                    $product->increment('stock_out_quantity', $detail['qty']);
                    $product->decrement('in_stock_quantity', $detail['qty']);
                }
            }

            // Create Extras
            if ($request->has('extras')) {
                foreach ($request->extras as $extra) {
                    $pos->extras()->create([
                        'title'  => $extra['title'],
                        'value'  => $extra['value'] ?? null,
                        'amount' => $extra['amount'],
                    ]);
                }
            }

            $pos->load(['details.product', 'customer', 'employee', 'extras', 'paymentMode', 'transactionType']);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS created successfully.',
                'data' => new PosResource($pos),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create POS',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a specific POS.
     */
    public function show($id)
    {
        $pos = Pos::with(['customer', 'employee', 'details.product', 'extras', 'paymentMode', 'transactionType'])
            ->find($id);

        if (!$pos) {
            return response()->json(['status' => false, 'message' => 'POS not found.'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'POS details retrieved successfully.',
            'data' => new PosResource($pos),
        ]);
    }

    /**
     * Update an existing POS.
     */
    public function update(Request $request, $id)
    {
        $pos = Pos::find($id);
        if (!$pos) {
            return response()->json(['status' => false, 'message' => 'POS not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'description'         => 'nullable|string',
            'tax'                 => 'nullable|numeric|min:0',
            'discPer'             => 'nullable|numeric|min:0|max:100',
            'discAmount'          => 'nullable|numeric|min:0',
            'inv_amount'          => 'nullable|numeric|min:0',
            'paid'                => 'nullable|numeric|min:0',
            'details'             => 'nullable|array',
            'details.*.product_id'=> 'required_with:details|exists:products,id',
            'details.*.qty'       => 'required_with:details|numeric|min:1',
            'details.*.sale_price'=> 'required_with:details|numeric|min:0',
            'extras'              => 'nullable|array',
            'extras.*.title'      => 'required_with:extras|string|max:255',
            'extras.*.value'      => 'nullable|string|max:255',
            'extras.*.amount'     => 'required_with:extras|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $pos->update($request->only([
                'inv_date', 'customer_id', 'employee_id', 'transaction_type_id',
                'description', 'tax', 'discPer', 'discAmount', 'inv_amount', 'paid'
            ]));


            // If details provided, replace them
            if ($request->has('details')) {
                $pos->details()->delete();
                foreach ($request->details as $detail) {
                    $pos->details()->create([
                        'product_id' => $detail['product_id'],
                        'qty'        => $detail['qty'],
                        'sale_price' => $detail['sale_price'],
                        'total'      => $detail['qty'] * $detail['sale_price'],
                    ]);
                }
            }

            // If extras provided, replace them
            if ($request->has('extras')) {
                $pos->extras()->delete();
                foreach ($request->extras as $extra) {
                    $pos->extras()->create([
                        'title'  => $extra['title'],
                        'value'  => $extra['value'] ?? null,
                        'amount' => $extra['amount'],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS updated successfully.',
                'data' => new PosResource($pos->fresh(['details', 'extras'])),
            ]);
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
     * Remove the specified POS.
     */
    public function destroy($id)
    {
        $pos = Pos::find($id);
        if (!$pos) {
            return response()->json(['status' => false, 'message' => 'POS not found.'], 404);
        }

        try {
            $pos->details()->delete();
            $pos->extras()->delete();
            $pos->delete();

            return response()->json(['status' => true, 'message' => 'POS deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete POS.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
