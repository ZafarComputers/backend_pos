<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosReturnResource;
use App\Models\PosReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Helpers\TransactionHelper;
use Illuminate\Support\Facades\Auth;



class PosReturnApiController extends Controller
{
    /**
     * Display all POS Returns.
     */
    public function index()
    {
        $returns = PosReturn::with(['customer', 'pos', 'details.product'])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data'   => PosReturnResource::collection($returns),
        ]);
    }

    /**
     * Store a new POS Return.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'          => 'required|exists:customers,id',
            'pos_id'               => 'required|exists:pos,id',
            'invRet_date'          => 'required|date',
            'reason'               => 'nullable|string',
            'details'              => 'required|array|min:1',
            'transaction_type_id'  => 'required|exists:payment_modes,id',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.return_unit_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ 1. Calculate total return amount
            $returnAmount = collect($request->details)
                ->sum(fn($item) => $item['qty'] * $item['return_unit_price']);

            // ✅ 2. Create POS Return record
            $posReturn = PosReturn::create([
                'customer_id'         => $request->customer_id,
                'pos_id'              => $request->pos_id,
                'invRet_date'         => $request->invRet_date,
                'reason'              => $request->reason,
                'return_inv_amout'    => $returnAmount,
                'transaction_type_id' => 3, // 3 = Sale Return
                'payment_mode_id'     => $request->payment_mode_id,
            ]);

            // ✅ 3. Save return details
            foreach ($request->details as $detail) {
                $posReturn->details()->create($detail);
            }

            // ✅ 4. Create double-entry transactions using helper
            TransactionHelper::createDoubleEntry(
                $request->invRet_date,
                $posReturn->id,
                3, // Sale Return transaction type
                $request->payment_mode_id, // Debit: Payment Mode (Cash/Bank)
                $request->customer_id,     // Credit: Customer
                Auth::id(),                // Current user ID
                'POS Sale Return - Customer ID: ' . $request->customer_id,
                $returnAmount
            );

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'POS Return created successfully with transactions.',
                'data'    => new PosReturnResource(
                    $posReturn->load(['customer', 'pos', 'details.product'])
                ),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create POS Return.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Show a single POS Return.
     */
    public function show($id)
    {
        $posReturn = PosReturn::with(['customer', 'pos', 'details.product'])->find($id);

        if (!$posReturn) {
            return response()->json([
                'status'  => false,
                'message' => 'POS Return not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => new PosReturnResource($posReturn),
        ]);
    }

    /**
     * Update a POS Return.
     */
    public function update(Request $request, $id)
    {
        $posReturn = PosReturn::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'customer_id'          => 'required|exists:customers,id',
            'pos_id'               => 'required|exists:pos,id',
            'invRet_date'          => 'required|date',
            'reason'               => 'nullable|string',
            'transaction_type_id'  => 'required|exists:payment_modes,id',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'details'              => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.return_unit_price' => 'required|numeric|min:0',
            'transaction_type_id'  => 'nullable|exists:transaction_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ Recalculate total amount
            $returnAmount = collect($request->details)
                ->sum(fn($item) => $item['qty'] * $item['return_unit_price']);

            // ✅ Update main record
            $posReturn->update([
                'customer_id'         => $request->customer_id,
                'pos_id'              => $request->pos_id,
                'invRet_date'         => $request->invRet_date,
                'reason'              => $request->reason,
                'return_inv_amout'    => $returnAmount,
                'transaction_type_id' => $request->transaction_type_id ?? 4,
                'payment_mode_id'     => $request->payment_mode_id,
            ]);

            // ✅ Replace details
            $posReturn->details()->delete();
            foreach ($request->details as $detail) {
                $posReturn->details()->create($detail);
            }

            // ✅ Remove existing transactions
            \App\Models\Transaction::where('invRef_id', $posReturn->id)->delete();

            // ✅ Create new double-entry transactions
            \App\Helpers\TransactionHelper::createDoubleEntry(
                $request->invRet_date,
                $posReturn->id,
                3, // Transaction type (POS Sale Return)
                $request->payment_mode_id, // Debit: Cash/Bank
                $request->customer_id,     // Credit: Customer
                auth()->id() ?? 1,         // Safe fallback user ID
                'POS Sale Return Updated - Customer ID: ' . $request->customer_id,
                $returnAmount
            );

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'POS Return updated successfully.',
                'data'    => new PosReturnResource(
                    $posReturn->load(['customer', 'pos', 'details.product'])
                ),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Failed to update POS Return.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Delete a POS Return.
     */
    public function destroy(PosReturn $posReturn)
    {
        try {
            $posReturn->details()->delete();
            $posReturn->delete();

            return response()->json([
                'status'  => true,
                'message' => 'POS Return deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to delete POS Return.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
