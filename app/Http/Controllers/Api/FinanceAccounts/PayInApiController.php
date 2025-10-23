<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use App\Models\PayIn;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayInApiController extends Controller
{
    public function index()
    {
        try {
            $data = PayIn::with(['transactionType', 'coa', 'user'])
                ->latest()
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No PayIn records found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayIns retrieved successfully.',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving PayIns: ' . $e->getMessage(),
            ], 500);
        }
    }


// Assuming this is in your PayInApiController or similar
public function store(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'transaction_types_id' => 'required|exists:transaction_types,id',
        'coas_id' => 'required|exists:coas,id',
        'users_id' => 'required|exists:users,id',
        'payment_modes_id' => 'required|in:1,2', // 1=Cash, 2=Bank
        'naration' => 'nullable|string',
        'description' => 'nullable|string',
        'amount' => 'required|numeric|min:0.01',
    ]);

    DB::beginTransaction();

    try {
        // 1️⃣ Create PayIn record
        $payIn = PayIn::create($validated);

        // 🔄 Determine main and counter accounts based on payment mode
        if ($validated['payment_modes_id'] == 1) { // Cash
            $mainCoaId = 3;             // Cash account
            $counterCoaId = $validated['coas_id'];
        } else { // Bank
            $mainCoaId = $validated['coas_id']; // Bank account
            $counterCoaId = 3;                  // Cash account? Adjust if needed (see notes below)
        }

        // 2️⃣ Debit Transaction
        $debit = Transaction::create([
            'date' => $validated['date'],
            'transaction_types_id' => $validated['transaction_types_id'],
            // 'transaction_type' => 'PayIn', // Remove if this field doesn't exist in transactions table
            'invRef_id' => $payIn->id,
            'coas_id' => $mainCoaId,     // ✅ Fixed: Use correct column name
            'coaRef_id' => $counterCoaId, // ✅ Fixed: Use correct column name
            'description' => $validated['description'] ?? 'PayIn Debit Entry',
            'debit' => $validated['amount'],
            'credit' => 0,
            'users_id' => $validated['users_id'],
        ]);

        // 3️⃣ Credit Transaction
        $credit = Transaction::create([
            'date' => $validated['date'],
            'transaction_types_id' => $validated['transaction_types_id'],
            // 'transaction_type' => 'PayIn', // Remove if this field doesn't exist in transactions table
            'invRef_id' => $payIn->id,
            'coas_id' => $counterCoaId,  // ✅ Fixed: Use correct column name (swapped for double-entry)
            'coaRef_id' => $mainCoaId,   // ✅ Fixed: Use correct column name (swapped for double-entry)
            'description' => $validated['description'] ?? 'PayIn Credit Entry',
            'debit' => 0,
            'credit' => $validated['amount'],
            'users_id' => $validated['users_id'],
        ]);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'PayIn created successfully with double entry.',
            'data' => [
                'pay_in' => $payIn,
                'transactions' => [$debit, $credit],
            ],
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => 'Error creating PayIn: ' . $e->getMessage(),
        ], 500);
    }
}


    public function show($id)
    {
        try {
            $data = PayIn::with(['transactionType', 'coa', 'user'])->find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Income record not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Income retrieved successfully.',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving Income: ' . $e->getMessage(),
            ], 500);
        }
    }


        /**
     * Update an existing PayIn
     */
    public function update(Request $request, $id)
    {
        // Manually find the PayIn record to ensure ID is valid
        $payIn = PayIn::find($id);

        // Check if PayIn exists
        if (!$payIn) {
            return response()->json([
                'status' => false,
                'message' => 'PayIn record not found for ID: ' . $id,
            ], 404);
        }

        $validated = $request->validate([
            'date' => 'sometimes|date',
            'transaction_types_id' => 'sometimes|exists:transaction_types,id',
            'coas_id' => 'sometimes|exists:coas,id',
            'users_id' => 'sometimes|exists:users,id',
            'payment_modes_id' => 'sometimes|in:1,2', // 1=Cash, 2=Bank
            'naration' => 'nullable|string',
            'description' => 'nullable|string',
            'amount' => 'sometimes|numeric|min:0.01',
        ]);

        DB::beginTransaction();

        try {
            // Update PayIn record
            $payIn->update($validated);

            // Delete existing transactions
            Transaction::where('invRef_id', $payIn->id)->delete();

            // Determine main and counter accounts based on payment mode
            $paymentModeId = $validated['payment_modes_id'] ?? $payIn->payment_modes_id ?? 1; // Default to 1 if null
            if ($paymentModeId == 1) { // Cash
                $mainCoaId = 3; // Cash account
                $counterCoaId = $validated['coas_id'] ?? $payIn->coas_id; // Income account
            } else { // Bank
                $mainCoaId = 7; // Bank account (adjust if needed)
                $counterCoaId = $validated['coas_id'] ?? $payIn->coas_id; // Income account
            }

            // Use updated values for transactions
            $transactionDate = $validated['date'] ?? $payIn->fresh()->date;
            $transactionTypeId = $validated['transaction_types_id'] ?? $payIn->fresh()->transaction_types_id;
            $transactionAmount = $validated['amount'] ?? $payIn->fresh()->amount;
            $transactionUserId = $validated['users_id'] ?? $payIn->fresh()->users_id;
            $transactionDescription = $validated['description'] ?? $payIn->fresh()->description ?? 'PayIn Entry';

            // Debit Transaction
            $debit = Transaction::create([
                'date' => $transactionDate,
                'transaction_types_id' => $transactionTypeId,
                'invRef_id' => $payIn->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $transactionDescription . ' (Debit)',
                'debit' => $transactionAmount,
                'credit' => 0,
                'users_id' => $transactionUserId,
            ]);

            // Credit Transaction
            $credit = Transaction::create([
                'date' => $transactionDate,
                'transaction_types_id' => $transactionTypeId,
                'invRef_id' => $payIn->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $transactionDescription . ' (Credit)',
                'debit' => 0,
                'credit' => $transactionAmount,
                'users_id' => $transactionUserId,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayIn updated successfully with double entry.',
                'data' => [
                    'pay_in' => $payIn->fresh(),
                    'transactions' => [$debit, $credit],
                ],
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
        // Manually find the PayIn record
        $payIn = PayIn::find($id);

        // Check if PayIn exists
        if (!$payIn) {
            return response()->json([
                'status' => false,
                'message' => 'PayIn record not found for ID: ' . $id,
            ], 404);
        }

        DB::beginTransaction();

        try {
            // Delete associated transactions
            Transaction::where('invRef_id', $payIn->id)->delete();

            // Delete the PayIn record
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
