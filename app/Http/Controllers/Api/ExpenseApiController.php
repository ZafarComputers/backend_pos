<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\TransactionHelper;

class ExpenseApiController extends Controller
{
    /**
     * Get all expenses.
     */
    public function index()
    {
        $expenses = Expense::with(['category', 'paymentMode'])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data'   => ExpenseResource::collection($expenses),
        ]);
    }

    /**
     * Store a new expense (with double-entry).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_mode_id' => 'required|exists:payment_modes,id', // Add this if using cash/bank
        ]);

        // Assign transaction type (Expense = 9)
        $validated['transaction_type_id'] = 9;

        // Create Expense Record
        $expense = Expense::create($validated);

        try {
            // === DOUBLE ENTRY LOGIC ===
            // 1️⃣ Determine COA IDs
            $expenseCoaId = Coa::where('name', 'Expenses')->value('id'); // or map via expense category
            $cashOrBankCoaId = Coa::where('name', 'Cash')->value('id');  // default if payment by cash

            // 2️⃣ Create Debit Entry (Expense Account)
            Transaction::create([
                'date' => $expense->date,
                'invRef_id' => $expense->id,
                'transaction_types_id' => $expense->transaction_type_id,
                'coas_id' => $expenseCoaId,
                'coaRef_id' => $cashOrBankCoaId,
                'users_id' => auth()->id(),
                'description' => "Expense: {$expense->name}",
                'debit' => $expense->amount,
                'credit' => 0,
            ]);

            // 3️⃣ Create Credit Entry (Cash/Bank Account)
            Transaction::create([
                'date' => $expense->date,
                'invRef_id' => $expense->id,
                'transaction_types_id' => $expense->transaction_type_id,
                'coas_id' => $cashOrBankCoaId,
                'coaRef_id' => $expenseCoaId,
                'users_id' => auth()->id(),
                'description' => "Expense Payment for {$expense->name}",
                'debit' => 0,
                'credit' => $expense->amount,
            ]);

            // ✅ Success response
            return response()->json([
                'status' => true,
                'message' => 'Expense created successfully (with double entry).',
                'data' => new ExpenseResource($expense->load(['category', 'transactionType'])),
            ], 201);

        } catch (\Exception $e) {
            // Rollback and return error
            $expense->delete(); // remove if expense save failed due to transaction
            return response()->json([
                'status' => false,
                'message' => 'Failed to create Expense.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Update an existing expense (with double-entry).
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'expense_name'       => 'required|string|max:255',
            'category_id'        => 'required|exists:categories,id',
            'description'        => 'nullable|string',
            'date'               => 'required|date',
            'amount'             => 'required|numeric|min:0',
            'payment_mode_id'    => 'required|exists:payment_modes,id',
            'transaction_type_id'=> 'nullable|exists:transaction_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // ✅ Update Expense
            $expense->update([
                'expense_name'        => $request->expense_name,
                'category_id'         => $request->category_id,
                'description'         => $request->description,
                'date'                => $request->date,
                'amount'              => $request->amount,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id ?? 9,
                'user_id'             => auth()->id() ?? 1,
            ]);

            // ✅ Remove old transactions
            Transaction::where('invRef_id', $expense->id)->delete();

            // ✅ Recreate double-entry
            TransactionHelper::createDoubleEntry(
                $request->date,
                $expense->id,
                $expense->transaction_type_id,
                $request->category_id,       // Debit: Expense category
                $request->payment_mode_id,   // Credit: Cash/Bank
                auth()->id() ?? 1,
                'Updated Expense - ' . $expense->expense_name,
                $request->amount
            );

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Expense updated successfully.',
                'data'    => new ExpenseResource($expense),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Failed to update Expense.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete an expense (and its transactions).
     */
    public function destroy(Expense $expense)
    {
        DB::beginTransaction();

        try {
            Transaction::where('invRef_id', $expense->id)->delete();
            $expense->delete();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Expense deleted successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Failed to delete Expense.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}