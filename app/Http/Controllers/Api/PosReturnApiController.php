<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\TransactionHelper;
use Illuminate\Support\Facades\Auth;

// Resources
use App\Http\Resources\PosReturnResource;

// Models
use App\Models\Product;
use App\Models\Transaction;
use App\Models\PosReturn;



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
    public function storeReturn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'             => 'required|date',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'transaction_type_id'  => 'nullable|exists:transaction_types,id',
            'customer_id'          => 'required|exists:customers,id',
            'bank_acc_id'          => 'nullable|exists:coas,id',
            'tax'                  => 'nullable|numeric|min:0',
            'discPer'              => 'nullable|numeric|min:0',
            'discAmount'           => 'nullable|numeric|min:0',
            'paid'                 => 'nullable|numeric|min:0',
            'details'              => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ Calculate totals
            $subtotal = collect($request->details)->sum(fn($d) => $d['qty'] * $d['sale_price']);
            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;
            $finalAmount = $subtotal - $discAmount + $tax;
            $paid = (float) ($request->paid ?? 0);

            $payment_status = match (true) {
                $paid >= $finalAmount => 'Refunded',
                $paid <= 0 => 'Unrefunded',
                default => 'Partial Refund',
            };

            // ✅ Create POS Return
            $posReturn = PosReturn::create([
                'inv_date'            => $request->inv_date,
                'customer_id'         => $request->customer_id,
                'tax'                 => $tax,
                'discPer'             => $request->discPer ?? 0,
                'discAmount'          => $discAmount,
                'inv_amount'          => $finalAmount,
                'paid'                => $paid,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id ?? 4, // 4 = Sale Return
                'payment_status'      => $payment_status,
            ]);

            // ✅ Store details and update stock (return adds stock back)
            foreach ($request->details as $detail) {
                $posReturn->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);

                $product = Product::find($detail['product_id']);
                if ($product) {
                    $product->increment('in_stock_quantity', $detail['qty']);
                    $product->decrement('stock_out_quantity', $detail['qty']);
                }
            }

            // ✅ Transactions
            $userId = Auth::id() ?? 1;
            $transTypeId = 4; // Sale Return
            $coaSalesReturn = 8; // COA for Sale Return
            $paymentModeId = (int) $request->payment_mode_id;

            $coaRefId = match ($paymentModeId) {
                1 => 3, // Cash
                2 => $request->bank_acc_id, // Bank
                3 => $request->customer_id, // Credit
                default => throw new \Exception("Invalid payment mode selected."),
            };

            if (empty($coaRefId) || !is_numeric($coaRefId)) {
                throw new \Exception('Invalid COA reference detected.');
            }

            // ✅ Debit Sale Return
            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $posReturn->id,
                'transaction_types_id' => $transTypeId,
                'coas_id' => $coaSalesReturn,
                'coaRef_id' => $coaRefId,
                'users_id' => $userId,
                'description' => 'POS Return: INV-' . $posReturn->id,
                'debit' => $finalAmount,
                'credit' => 0,
            ]);

            // ✅ Credit Cash/Bank/Customer
            if ($payment_status === 'Refunded') {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return (Full Refund): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $finalAmount,
                ]);
            } elseif ($payment_status === 'Partial Refund') {
                $balance = $finalAmount - $paid;

                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return (Partial Refund): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $paid,
                ]);

                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return (Balance Unpaid): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $balance,
                ]);
            } else {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return (On Credit): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $finalAmount,
                ]);
            }

            DB::commit();

            $posReturn->load(['details.product', 'customer']);
            return response()->json([
                'status' => true,
                'message' => 'POS Return created successfully.',
                'data' => new PosReturnResource($posReturn),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Failed to create POS Return', 'error' => $e->getMessage()], 500);
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
    public function updateReturn(Request $request, PosReturn $posReturn)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'             => 'required|date',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'transaction_type_id'  => 'nullable|exists:transaction_types,id',
            'customer_id'          => 'required|exists:customers,id',
            'bank_acc_id'          => 'nullable|exists:coas,id',
            'tax'                  => 'nullable|numeric|min:0',
            'discPer'              => 'nullable|numeric|min:0',
            'discAmount'           => 'nullable|numeric|min:0',
            'paid'                 => 'nullable|numeric|min:0',
            'details'              => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ Revert old stock
            foreach ($posReturn->details as $oldDetail) {
                $product = Product::find($oldDetail->product_id);
                if ($product) {
                    $product->decrement('in_stock_quantity', $oldDetail->qty);
                    $product->increment('stock_out_quantity', $oldDetail->qty);
                }
            }

            // Delete old details
            $posReturn->details()->delete();

            // Recalculate totals
            $subtotal = collect($request->details)->sum(fn($d) => $d['qty'] * $d['sale_price']);
            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;
            $finalAmount = $subtotal - $discAmount + $tax;
            $paid = (float) ($request->paid ?? 0);

            $payment_status = match (true) {
                $paid >= $finalAmount => 'Refunded',
                $paid <= 0 => 'Unrefunded',
                default => 'Partial Refund',
            };

            // ✅ Update POS Return
            $posReturn->update([
                'inv_date'            => $request->inv_date,
                'customer_id'         => $request->customer_id,
                'tax'                 => $tax,
                'discPer'             => $request->discPer ?? 0,
                'discAmount'          => $discAmount,
                'inv_amount'          => $finalAmount,
                'paid'                => $paid,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id ?? 4,
                'payment_status'      => $payment_status,
            ]);

            // ✅ Add new details and adjust stock
            foreach ($request->details as $detail) {
                $posReturn->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);

                $product = Product::find($detail['product_id']);
                if ($product) {
                    $product->increment('in_stock_quantity', $detail['qty']);
                    $product->decrement('stock_out_quantity', $detail['qty']);
                }
            }

            // ✅ Recreate Transactions
            Transaction::where('invRef_id', $posReturn->id)
                ->where('transaction_types_id', 4)
                ->delete();

            $userId = Auth::id() ?? 1;
            $coaSalesReturn = 8;
            $paymentModeId = (int) $request->payment_mode_id;

            $coaRefId = match ($paymentModeId) {
                1 => 3,
                2 => $request->bank_acc_id,
                3 => $request->customer_id,
                default => throw new \Exception("Invalid payment mode selected."),
            };

            // Debit Sale Return
            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $posReturn->id,
                'transaction_types_id' => 4,
                'coas_id' => $coaSalesReturn,
                'coaRef_id' => $coaRefId,
                'users_id' => $userId,
                'description' => 'POS Return Update: INV-' . $posReturn->id,
                'debit' => $finalAmount,
                'credit' => 0,
            ]);

            // Credit Side Logic (Refund / Partial / Credit)
            if ($payment_status === 'Refunded') {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => 4,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return Update (Full Refund): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $finalAmount,
                ]);
            } elseif ($payment_status === 'Partial Refund') {
                $balance = $finalAmount - $paid;

                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => 4,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return Update (Partial Refund): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $paid,
                ]);

                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => 4,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return Update (Balance Unpaid): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $balance,
                ]);
            } else {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $posReturn->id,
                    'transaction_types_id' => 4,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSalesReturn,
                    'users_id' => $userId,
                    'description' => 'POS Return Update (Credit): INV-' . $posReturn->id,
                    'debit' => 0,
                    'credit' => $finalAmount,
                ]);
            }

            DB::commit();

            $posReturn->load(['details.product', 'customer']);
            return response()->json([
                'status' => true,
                'message' => 'POS Return updated successfully.',
                'data' => new PosReturnResource($posReturn),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Failed to update POS Return', 'error' => $e->getMessage()], 500);
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