<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Expense;
use App\Models\Transaction;
use App\Models\PayIn;

// Resource
use App\Http\Resources\PayInResource;

class PayInApiController extends Controller
{
    /**
     * Retrieve all PayIn records
     */
    public function index()
    {
        try {
            $data = PayIn::with(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ->latest()
                ->get();

                // dd($data);

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No PayIn records found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayIns retrieved successfully.',
                'data' => PayInResource::collection($data),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving PayIns: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new PayIn
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'coas_id' => 'required|exists:coas,id',
            'users_id' => 'required|exists:users,id',
            'payment_mode_id' => 'required|in:1,2', // 1=Cash, 2=Bank (example)
            'income_category_id' => 'required|exists:coas,id',
            'name' => 'nullable|string|max:255',
            'naration' => 'nullable|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Create the PayIn record
            $payIn = PayIn::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'coas_id' => $validated['coas_id'],
                'users_id' => $validated['users_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'income_category_id' => $validated['income_category_id'],
                'naration' => $validated['naration'] ?? null,
                'description' => $validated['description'] ?? null,
                'amount' => $validated['amount'],
            ]);

            // ✅ Optional: Record Expense entry (commented if not needed)
            /*
            $income = Expense::create([
                'name' => $validated['name'] ?? 'Auto Expense',
                'income_category_id' => $validated['income_category_id'],
                'description' => $validated['description'] ?? 'Expense recorded from PayIn',
                'date' => $validated['date'],
                'amount' => $validated['amount'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
            ]);
            */

            // ✅ Transaction Entries
            $mainCoaId = $validated['payment_mode_id'] == 1 ? 3 : 7; // Example: 1=Cash (3), 2=Bank (7)
            $counterCoaId = $validated['coas_id'];

            // 🔹 Debit Entry (Cash/Bank decreases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'], // ✅ correct key
                'invRef_id' => $payIn->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $validated['description'] ?? 'PayIn Credit Entry',
                'debit' => $validated['amount'],
                'credit' => 0,
                'users_id' => $validated['users_id'],
            ]);

            // 🔹 Credit Entry (Income increases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'invRef_id' => $payIn->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $validated['description'] ?? 'PayIn Debit Entry',
                'debit' => 0,
                'credit' => $validated['amount'],
                'users_id' => $validated['users_id'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayIn created successfully.',
                'data' => new PayInResource(
                    $payIn->load(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Error creating PayIn: ' . $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Retrieve a single PayIn record
     */
    public function show($id)
    {
        try {
            $data = PayIn::with(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ->find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'PayIn record not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayIn retrieved successfully.',
                'data' => new PayInResource($data),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving PayIn: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing PayIn
     */
    public function update(Request $request, PayIn $income)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'coas_id' => 'required|exists:coas,id',
            'users_id' => 'required|exists:users,id',
            'payment_mode_id' => 'required|in:1,2', // 1=Cash, 2=Bank
            'income_category_id' => 'required|exists:coas,id',
            'name' => 'nullable|string|max:255',
            'naration' => 'nullable|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Update the PayIn record
            $income->update([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'coas_id' => $validated['coas_id'],
                'users_id' => $validated['users_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'income_category_id' => $validated['income_category_id'],
                'naration' => $validated['naration'] ?? null,
                'description' => $validated['description'] ?? null,
                'amount' => $validated['amount'],
            ]);

            // ✅ Prepare transaction COA IDs
            $mainCoaId = $validated['payment_mode_id'] == 1 ? 3 : 7; // Cash:3, Bank:7
            $counterCoaId = $validated['coas_id'];

            // ✅ Delete old transaction records for this PayIn
            Transaction::where('invRef_id', $income->id)->delete();

            // 🔹 Re-create Credit Entry (Cash/Bank decreases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'invRef_id' => $income->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $validated['description'] ?? 'PayIn Credit Entry',
                'debit' => 0,
                'credit' => $validated['amount'],
                'users_id' => $validated['users_id'],
            ]);

            // 🔹 Re-create Debit Entry (Expense increases)
            Transaction::create([
                'date' => $validated['date'],
                'transaction_type_id' => $validated['transaction_type_id'],
                'invRef_id' => $income->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $validated['description'] ?? 'PayIn Debit Entry',
                'debit' => $validated['amount'],
                'credit' => 0,
                'users_id' => $validated['users_id'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayIn updated successfully.',
                'data' => new PayInResource(
                    $income->load(['transactionType', 'coa', 'user', 'paymentMode', 'transactions'])
                ),
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Error updating PayIn: ' . $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Delete a PayIn record and its associated transactions
     */
    public function destroy($id)
    {
        $payIn = PayIn::find($id);

        if (!$payIn) {
            return response()->json([
                'status' => false,
                'message' => 'PayIn record not found for ID: ' . $id,
            ], 404);
        }

        DB::beginTransaction();

        try {
            Transaction::where('invRef_id', $payIn->id)->delete();
            $payIn->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayIn deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error deleting PayIn: ' . $e->getMessage(),
            ], 500);
        }
    }
}
