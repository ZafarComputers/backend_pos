<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Expense;
use App\Models\Transaction;
use App\Models\PayOut;

// Resource
use App\Http\Resources\PayOutResource;

class PayOutApiController extends Controller
{
    /**
     * Retrieve all PayOut records
     */
    public function index()
    {
        try {
            $data = PayOut::with(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ->latest()
                ->get();

                // dd($data);

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No PayOut records found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayOuts retrieved successfully.',
                'data' => PayOutResource::collection($data),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving PayOuts: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new PayOut
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'coas_id' => 'required|exists:coas,id',
            'users_id' => 'required|exists:users,id',
            'payment_mode_id' => 'required|in:1,2', // 1=Cash, 2=Bank (example)
            'expense_category_id' => 'required|exists:coas,id',
            'name' => 'nullable|string|max:255',
            'naration' => 'nullable|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Create the PayOut record
            $payOut = PayOut::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'coas_id' => $validated['coas_id'],
                'users_id' => $validated['users_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'expense_category_id' => $validated['expense_category_id'],
                'naration' => $validated['naration'] ?? null,
                'description' => $validated['description'] ?? null,
                'amount' => $validated['amount'],
            ]);

            // ✅ Optional: Record Expense entry (commented if not needed)
            /*
            $expense = Expense::create([
                'name' => $validated['name'] ?? 'Auto Expense',
                'expense_category_id' => $validated['expense_category_id'],
                'description' => $validated['description'] ?? 'Expense recorded from PayOut',
                'date' => $validated['date'],
                'amount' => $validated['amount'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
            ]);
            */

            // ✅ Transaction Entries
            $mainCoaId = $validated['payment_mode_id'] == 1 ? 3 : 7; // Example: 1=Cash (3), 2=Bank (7)
            $counterCoaId = $validated['coas_id'];

            // 🔹 Credit Entry (Cash/Bank decreases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'], // ✅ correct key
                'invRef_id' => $payOut->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $validated['description'] ?? 'PayOut Credit Entry',
                'debit' => 0,
                'credit' => $validated['amount'],
                'users_id' => $validated['users_id'],
            ]);

            // 🔹 Debit Entry (Expense increases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'invRef_id' => $payOut->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $validated['description'] ?? 'PayOut Debit Entry',
                'debit' => $validated['amount'],
                'credit' => 0,
                'users_id' => $validated['users_id'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayOut created successfully.',
                'data' => new PayOutResource(
                    $payOut->load(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Error creating PayOut: ' . $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Retrieve a single PayOut record
     */
    public function show($id)
    {
        try {
            $data = PayOut::with(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ->find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'PayOut record not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayOut retrieved successfully.',
                'data' => new PayOutResource($data),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving PayOut: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing PayOut
     */
    // public function update(Request $request, PayOut $payOut)
    public function update(Request $request, PayOut $expense)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'coas_id' => 'required|exists:coas,id',
            'users_id' => 'required|exists:users,id',
            'payment_mode_id' => 'required|in:1,2', // 1=Cash, 2=Bank
            'expense_category_id' => 'required|exists:coas,id',
            'name' => 'nullable|string|max:255',
            'naration' => 'nullable|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Update the PayOut record
            $expense->update([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'coas_id' => $validated['coas_id'],
                'users_id' => $validated['users_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'expense_category_id' => $validated['expense_category_id'],
                'naration' => $validated['naration'] ?? null,
                'description' => $validated['description'] ?? null,
                'amount' => $validated['amount'],
            ]);

            // ✅ Prepare transaction COA IDs
            $mainCoaId = $validated['payment_mode_id'] == 1 ? 3 : 7; // Cash:3, Bank:7
            $counterCoaId = $validated['coas_id'];

            // ✅ Delete old transaction records for this PayOut
            Transaction::where('invRef_id', $expense->id)->delete();

            // 🔹 Re-create Credit Entry (Cash/Bank decreases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'invRef_id' => $expense->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $validated['description'] ?? 'PayOut Credit Entry',
                'debit' => 0,
                'credit' => $validated['amount'],
                'users_id' => $validated['users_id'],
            ]);

            // 🔹 Re-create Debit Entry (Expense increases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'invRef_id' => $expense->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $validated['description'] ?? 'PayOut Debit Entry',
                'debit' => $validated['amount'],
                'credit' => 0,
                'users_id' => $validated['users_id'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayOut updated successfully.',
                'data' => new PayOutResource(
                    $expense->load(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Error updating PayOut: ' . $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Delete a PayOut record and its associated transactions
     */
    public function destroy($id)
    {
        $payOut = PayOut::find($id);

        if (!$payOut) {
            return response()->json([
                'status' => false,
                'message' => 'PayOut record not found for ID: ' . $id,
            ], 404);
        }

        DB::beginTransaction();

        try {
            Transaction::where('invRef_id', $payOut->id)->delete();
            $payOut->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayOut deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error deleting PayOut: ' . $e->getMessage(),
            ], 500);
        }
    }
}
