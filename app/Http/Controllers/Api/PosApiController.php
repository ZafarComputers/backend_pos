<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Resources
use App\Http\Resources\PosResource;
use App\Http\Resources\PosNoDtlResource;

// Models
use App\Models\Pos;
use App\Models\Product;
use App\Models\Transaction;

class PosApiController extends Controller
{
    /**
     * Display all POS records.
     */
    public function index()
    {
        $pos = Pos::with('details')->latest()->get();
        return PosNoDtlResource::collection($pos);
    }

    /**
     * Store a new POS record with transactions.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'             => 'required|date',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'transaction_type_id'  => 'nullable|exists:transaction_types,id',
            'customer_id'          => 'required|exists:customers,id',
            'coa_id'               => 'nullable|exists:coas,id',
            'coaRef_id'            => 'nullable|exists:coas,id',
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
                $paid >= $finalAmount => 'Paid',
                $paid <= 0 => 'Unpaid',
                default => 'Partial',
            };

            // ✅ Create POS
            $pos = Pos::create([
                'inv_date'            => $request->inv_date,
                'customer_id'         => $request->customer_id,
                'tax'                 => $tax,
                'discPer'             => $request->discPer ?? 0,
                'discAmount'          => $discAmount,
                'inv_amount'          => $finalAmount,
                'paid'                => $paid,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id,
                'payment_status'      => $payment_status,
            ]);

            // ✅ Store details & update product stock
            foreach ($request->details as $detail) {
                $pos->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);

                // 🔹 Update product stock
                $product = Product::find($detail['product_id']);
                if ($product) {
                    $product->increment('stock_out_quantity', $detail['qty']);
                    $product->decrement('in_stock_quantity', $detail['qty']);
                }
            }

            // ✅ Transaction entries
            $userId = Auth::id() ?? 1;
            $transTypeId = $request->transaction_type_id ?? 2; // Sale
            $coaSales = 7; // Sales Account
            $paymentModeId = (int) $request->payment_mode_id;

            // Determine COA based on payment mode
            $coaRefId = match ($paymentModeId) {
                1 => 3, // Cash
                2 => $request->bank_acc_id, // Bank
                3 => $request->customer_id, // Credit
                default => throw new \Exception("Invalid payment mode selected."),
            };

            if (empty($coaRefId) || !is_numeric($coaRefId)) {
                throw new \Exception('Invalid COA reference detected.');
            }

            // ✅ Create transaction entries
            // Credit Sale Account
            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $pos->id,
                'transaction_types_id' => $transTypeId,
                'coas_id' => $coaSales,
                'coaRef_id' => $coaRefId,
                'users_id' => $userId,
                'description' => 'POS Sale: INV-' . $pos->id,
                'debit' => 0,
                'credit' => $finalAmount,
            ]);

            // ✅ Debit logic based on payment
            if ($payment_status === 'Paid') {
                // Fully paid — debit full amount to Cash/Bank
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (Full Payment): INV-' . $pos->id,
                    'debit' => $finalAmount,
                    'credit' => 0,
                ]);
            } elseif ($payment_status === 'Partial') {
                // Partial payment — split debit between cash/bank and customer
                $balance = $finalAmount - $paid;

                // Debit paid amount to Cash/Bank
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (Partial Payment Received): INV-' . $pos->id,
                    'debit' => $paid,
                    'credit' => 0,
                ]);

                // Debit remaining balance to Customer Account
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (Balance Due): INV-' . $pos->id,
                    'debit' => $balance,
                    'credit' => 0,
                ]);
            } else {
                // Unpaid — debit total to Customer
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (On Credit): INV-' . $pos->id,
                    'debit' => $finalAmount,
                    'credit' => 0,
                ]);
            }

            DB::commit();

            $pos->load(['details.product', 'customer']);
            return response()->json([
                'status' => true,
                'message' => 'POS created successfully.',
                'data' => new PosResource($pos),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Failed to create POS', 'error' => $e->getMessage()], 500);
        }
    }



    /**
     * Show a single POS.
     */
    public function show($id)
    {
        $pos = Pos::with(['customer', 'details.product'])->find($id);

        if (!$pos) {
            return response()->json(['status' => false, 'message' => 'POS not found.'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => new PosResource($pos),
        ]);
    }

    /**
     * Update POS with transactions.
     */
    public function update(Request $request, Pos $pos)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'             => 'required|date',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'transaction_type_id'  => 'nullable|exists:transaction_types,id',
            'customer_id'          => 'required|exists:customers,id',
            'coa_id'               => 'nullable|exists:coas,id',
            'coaRef_id'            => 'nullable|exists:coas,id',
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
            // ✅ Recalculate amounts
            $subtotal = collect($request->details)->sum(fn($d) => $d['qty'] * $d['sale_price']);
            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;
            $finalAmount = $subtotal - $discAmount + $tax;
            $paid = (float) ($request->paid ?? 0);

            $payment_status = match (true) {
                $paid >= $finalAmount => 'Paid',
                $paid <= 0 => 'Unpaid',
                default => 'Partial',
            };

            // ✅ Revert previous stock (add back quantities to stock)
            foreach ($pos->details as $oldDetail) {
                $product = Product::find($oldDetail->product_id);
                if ($product) {
                    $product->decrement('stock_out_quantity', $oldDetail->qty);
                    $product->increment('in_stock_quantity', $oldDetail->qty);
                }
            }

            // ✅ Delete old details
            $pos->details()->delete();

            // ✅ Update POS record
            $pos->update([
                'inv_date'            => $request->inv_date,
                'customer_id'         => $request->customer_id,
                'tax'                 => $tax,
                'discPer'             => $request->discPer ?? 0,
                'discAmount'          => $discAmount,
                'inv_amount'          => $finalAmount,
                'paid'                => $paid,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id,
                'payment_status'      => $payment_status,
            ]);

            // ✅ Insert new details and adjust stock
            foreach ($request->details as $detail) {
                $pos->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);

                // Update stock
                $product = Product::find($detail['product_id']);
                if ($product) {
                    $product->increment('stock_out_quantity', $detail['qty']);
                    $product->decrement('in_stock_quantity', $detail['qty']);
                }
            }

            // ✅ Delete old transaction entries
            Transaction::where('invRef_id', $pos->id)
                ->where('transaction_types_id', $pos->transaction_type_id)
                ->delete();

            // ✅ Recreate new transaction entries
            $userId = Auth::id() ?? 1;
            $transTypeId = $request->transaction_type_id ?? 2; // Sale
            $coaSales = 7; // Sales Account
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

            // Credit sale account
            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $pos->id,
                'transaction_types_id' => $transTypeId,
                'coas_id' => $coaSales,
                'coaRef_id' => $coaRefId,
                'users_id' => $userId,
                'description' => 'POS Update: INV-' . $pos->id,
                'debit' => 0,
                'credit' => $finalAmount,
            ]);

            // Debit logic same as store()
            if ($payment_status === 'Paid') {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Update (Full Payment): INV-' . $pos->id,
                    'debit' => $finalAmount,
                    'credit' => 0,
                ]);
            } elseif ($payment_status === 'Partial') {
                $balance = $finalAmount - $paid;

                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Update (Partial Payment): INV-' . $pos->id,
                    'debit' => $paid,
                    'credit' => 0,
                ]);

                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Update (Balance Due): INV-' . $pos->id,
                    'debit' => $balance,
                    'credit' => 0,
                ]);
            } else {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_types_id' => $transTypeId,
                    'coas_id' => $request->customer_id,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Update (On Credit): INV-' . $pos->id,
                    'debit' => $finalAmount,
                    'credit' => 0,
                ]);
            }

            DB::commit();

            $pos->load(['details.product', 'customer']);
            return response()->json([
                'status' => true,
                'message' => 'POS updated successfully.',
                'data' => new PosResource($pos),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update POS',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Delete POS and its transactions.
     */
    public function destroy(Pos $pos)
    {
        try {
            $pos->details()->delete();
            Transaction::where('invRef_id', $pos->id)->delete();
            $pos->delete();

            return response()->json(['status' => true, 'message' => 'POS deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Today's Summary (Sale, Expense, Profit).
     */
    public function todaySummary()
    {
        $today = Carbon::now('Asia/Karachi')->toDateString();

        $todaysSale = Pos::whereDate('inv_date', $today)->sum('inv_amount');

        $todaysExpense = Transaction::whereDate('date', $today)
            ->whereHas('coa.coaSub.coaMain', fn($q) => $q->where('id', 6))
            ->sum('debit');

        $todaysEarning = $todaysSale - $todaysExpense;

        return response()->json([
            'status' => true,
            'message' => 'Today summary retrieved successfully.',
            'data' => [
                'date' => $today,
                'Sales' => round($todaysSale, 2),
                'Expenses' => round($todaysExpense, 2),
                'Earning' => round($todaysEarning, 2),
            ],
        ]);
    }
}
