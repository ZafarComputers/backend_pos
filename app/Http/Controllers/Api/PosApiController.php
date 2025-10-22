<?php

namespace App\Http\Controllers\Api;

// Controllers
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
use App\Models\PosDetail;
use App\Models\PosBankDetail;
use App\Models\Transaction;
use App\Models\Coa;



class PosApiController extends Controller
{
    /**
     * Display all POS records
     */
    public function index()
    {
        $pos = Pos::with(['details'])->latest()->get();
        return PosNoDtlResource::collection($pos);
    }

    /**
     * Store a new POS record with transactions
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'       => 'required|date',
            'customer_id'    => 'required|exists:customers,id',
            'tax'            => 'nullable|numeric|min:0',
            'discPer'        => 'nullable|numeric|min:0',
            'discAmount'     => 'nullable|numeric|min:0',
            'inv_amount'     => 'nullable|numeric|min:0',
            'paid'           => 'nullable|numeric|min:0',
            'transaction_type_id' => 'nullable|exists:transaction_types,id',
            'payment_mode_id'     => 'required|exists:payment_modes,id',
            'details'        => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $subtotal = collect($request->details)
                ->sum(fn($item) => $item['qty'] * $item['sale_price']);

            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;
            $finalAmount = $subtotal - $discAmount + $tax;
            $paid = $request->filled('paid') ? (float) $request->paid : 0.0;

            $payment_status = $paid >= $finalAmount ? 'Paid' : ($paid <= 0 ? 'Unpaid' : 'Partial');

            // ✅ Create POS record
            $pos = Pos::create([
                'inv_date'       => $request->inv_date,
                'customer_id'    => $request->customer_id,
                'tax'            => $tax,
                'discPer'        => $request->discPer ?? 0,
                'discAmount'     => $discAmount,
                'inv_amount'     => $finalAmount,
                'paid'           => $paid,
                'payment_mode_id' => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id,
                'payment_status' => $payment_status,
            ]);

            // ✅ Create details
            foreach ($request->details as $detail) {
                $pos->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty' => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'total' => $detail['qty'] * $detail['sale_price'],
                ]);
            }

            // ✅ Double Entry Transaction Logic
            $userId = Auth::id() ?? 1;
            $transTypeId = $request->transaction_type_id ?? 2; // 2 = Sale Transaction
            $coaSales = 4; // Example: Sales Account
            $coaRefId = match ($request->payment_mode_id) {
                1 => 3, // Cash
                2 => 4, // Bank
                3 => $request->customer_id, // Credit/Customer
                default => throw new \UnhandledMatchError("Invalid payment mode."),
            };

            // 1️⃣ Debit Entry (Customer/Bank/Cash)
            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $pos->id,
                'transaction_types_id' => $transTypeId,
                'coas_id' => $coaRefId,
                'coaRef_id' => $coaSales,
                'users_id' => $userId,
                'description' => 'POS Sale: INV-' . $pos->id,
                'debit' => $finalAmount,
                'credit' => 0,
            ]);

            // 2️⃣ Credit Entry (Sales)
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

            DB::commit();

            $pos->load(['details.product', 'customer']);
            return response()->json(['status' => true, 'message' => 'POS created successfully', 'data' => new PosResource($pos)], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Failed to create POS', 'error' => $e->getMessage()], 500);
        }
    }



    /**
     * Show a single POS Return.
     */
    public function show($id)
    {
        // $pos = Pos::with(['customer', 'pos', 'details.product'])->find($id);
        $pos = Pos::with(['customer', 'details'])->find($id);

        if (!$pos) {
            return response()->json([
                'status'  => false,
                'message' => 'POS Invoice not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => new PosResource($pos),
        ]);
    }




    /**
     * Update POS with transactions
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'inv_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'tax' => 'nullable|numeric|min:0',
            'discAmount' => 'nullable|numeric|min:0',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
            'payment_mode_id' => 'required|exists:payment_modes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $pos = Pos::findOrFail($id);
            $subtotal = collect($request->details)
                ->sum(fn($item) => $item['qty'] * $item['sale_price']);
            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;
            $finalAmount = $subtotal - $discAmount + $tax;

            $pos->update([
                'inv_date' => $request->inv_date,
                'customer_id' => $request->customer_id,
                'tax' => $tax,
                'discAmount' => $discAmount,
                'inv_amount' => $finalAmount,
                'payment_mode_id' => $request->payment_mode_id,
            ]);

            $pos->details()->delete();
            foreach ($request->details as $detail) {
                $pos->details()->create($detail);
            }

            // Remove old transactions and recreate
            Transaction::where('invRef_id', $pos->id)->delete();

            $userId = Auth::id() ?? 1;
            $transTypeId = $request->transaction_type_id ?? 2;
            $coaSales = 4;
            $coaRefId = match ($request->payment_mode_id) {
                1 => 3,
                2 => 4,
                3 => $request->customer_id,
                default => throw new \UnhandledMatchError("Invalid payment mode."),
            };

            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $pos->id,
                'transaction_types_id' => $transTypeId,
                'coas_id' => $coaRefId,
                'coaRef_id' => $coaSales,
                'users_id' => $userId,
                'description' => 'Updated POS Sale: INV-' . $pos->id,
                'debit' => $finalAmount,
                'credit' => 0,
            ]);

            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $pos->id,
                'transaction_types_id' => $transTypeId,
                'coas_id' => $coaSales,
                'coaRef_id' => $coaRefId,
                'users_id' => $userId,
                'description' => 'Updated POS Sale: INV-' . $pos->id,
                'debit' => 0,
                'credit' => $finalAmount,
            ]);

            DB::commit();

            $pos->load(['details.product', 'customer']);
            return response()->json(['status' => true, 'message' => 'POS updated successfully', 'data' => new PosResource($pos)], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Failed to update POS', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete POS and its transactions
     */
    public function destroy(Pos $po)
    {
        try {
            $po->details()->delete();
            Transaction::where('invRef_id', $po->id)->delete();
            $po->delete();
            return response()->json(['message' => 'POS deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // Today's Summary: Sale, Expense, Profit
    public function todaySummary()
    {
        // ✅ Use your local timezone for accuracy (important if DB stores UTC)
        $today = Carbon::now('Asia/Karachi')->toDateString();

        // ✅ Today's total sales
        $todaysSale = Pos::whereDate('inv_date', $today)
            ->sum('inv_amount');

        // ✅ Today's total expenses (where coa_main_id = 6)
        $todaysExpense = Transaction::whereDate('date', $today)
            ->whereHas('coa.coaSub.coaMain', function ($query) {
                $query->where('id', 6);
            })
            ->sum('debit');

        // ✅ Profit = Sale - Expense
        $todaysEarning = $todaysSale - $todaysExpense;

        // ✅ Return clean JSON response
        return response()->json([
            'status'   => true,
            'message'  => 'Today\'s financial summary retrieved successfully.',
            'data' => [
                'date'     => $today,
                'Sales'    => round($todaysSale, 2),
                'Expenses' => round($todaysExpense, 2),
                'Earning'   => round($todaysEarning, 2),
            ],
        ], 200);
    }



}
