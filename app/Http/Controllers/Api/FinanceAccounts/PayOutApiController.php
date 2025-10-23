<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use App\Models\PayOut;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayOutApiController extends Controller
{
    /**
     * Retrieve all PayOut records
     */
    public function index()
    {
        try {
            $data = PayOut::with(['transactionType', 'coa', 'user'])
                ->latest()
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No PayOut records found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayOuts retrieved successfully.',
                'data' => $data,
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
            // Create PayOut record
            $payOut = PayOut::create($validated);

            // Determine main and counter accounts based on payment mode
            if ($validated['payment_modes_id'] == 1) { // Cash
                $mainCoaId = 3; // Cash account
                $counterCoaId = $validated['coas_id']; // Expense account
            } else { // Bank
                $mainCoaId = 7; // Bank account (adjust if needed)
                $counterCoaId = $validated['coas_id']; // Expense account
            }

            // Credit Transaction (swapped from PayIn: Cash/Bank decreases)
            $credit = Transaction::create([
                'date' => $validated['date'],
                'transaction_types_id' => $validated['transaction_types_id'],
                'invRef_id' => $payOut->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $validated['description'] ?? 'PayOut Credit Entry',
                'debit' => 0,
                'credit' => $validated['amount'],
                'users_id' => $validated['users_id'],
            ]);

            // Debit Transaction (swapped from PayIn: Expense increases)
            $debit = Transaction::create([
                'date' => $validated['date'],
                'transaction_types_id' => $validated['transaction_types_id'],
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
                'message' => 'PayOut created successfully with double entry.',
                'data' => [
                    'pay_out' => $payOut,
                    'transactions' => [$credit, $debit],
                ],
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
            $data = PayOut::with(['transactionType', 'coa', 'user'])->find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'PayOut record not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'PayOut retrieved successfully.',
                'data' => $data,
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
    public function update(Request $request, $id)
    {
        // Manually find the PayOut record
        $payOut = PayOut::find($id);

        // Check if PayOut exists
        if (!$payOut) {
            return response()->json([
                'status' => false,
                'message' => 'PayOut record not found for ID: ' . $id,
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
            // Update PayOut record
            $payOut->update($validated);

            // Delete existing transactions
            Transaction::where('invRef_id', $payOut->id)->delete();

            // Determine main and counter accounts based on payment mode
            $paymentModeId = $validated['payment_modes_id'] ?? $payOut->payment_modes_id ?? 1; // Default to 1 if null
            if ($paymentModeId == 1) { // Cash
                $mainCoaId = 3; // Cash account
                $counterCoaId = $validated['coas_id'] ?? $payOut->coas_id; // Expense account
            } else { // Bank
                $mainCoaId = 7; // Bank account (adjust if needed)
                $counterCoaId = $validated['coas_id'] ?? $payOut->coas_id; // Expense account
            }

            // Use updated values for transactions
            $transactionDate = $validated['date'] ?? $payOut->fresh()->date;
            $transactionTypeId = $validated['transaction_types_id'] ?? $payOut->fresh()->transaction_types_id;
            $transactionAmount = $validated['amount'] ?? $payOut->fresh()->amount;
            $transactionUserId = $validated['users_id'] ?? $payOut->fresh()->users_id;
            $transactionDescription = $validated['description'] ?? $payOut->fresh()->description ?? 'PayOut Entry';

            // Credit Transaction (swapped from PayIn: Cash/Bank decreases)
            $credit = Transaction::create([
                'date' => $transactionDate,
                'transaction_types_id' => $transactionTypeId,
                'invRef_id' => $payOut->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $transactionDescription . ' (Credit)',
                'debit' => 0,
                'credit' => $transactionAmount,
                'users_id' => $transactionUserId,
            ]);

            // Debit Transaction (swapped from PayIn: Expense increases)
            $debit = Transaction::create([
                'date' => $transactionDate,
                'transaction_types_id' => $transactionTypeId,
                'invRef_id' => $payOut->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $transactionDescription . ' (Debit)',
                'debit' => $transactionAmount,
                'credit' => 0,
                'users_id' => $transactionUserId,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'PayOut updated successfully with double entry.',
                'data' => [
                    'pay_out' => $payOut->fresh(),
                    'transactions' => [$credit, $debit],
                ],
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
        // Manually find the PayOut record
        $payOut = PayOut::find($id);

        // Check if PayOut exists
        if (!$payOut) {
            return response()->json([
                'status' => false,
                'message' => 'PayOut record not found for ID: ' . $id,
            ], 404);
        }

        DB::beginTransaction();

        try {
            // Delete associated transactions
            Transaction::where('invRef_id', $payOut->id)->delete();

            // Delete the PayOut record
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