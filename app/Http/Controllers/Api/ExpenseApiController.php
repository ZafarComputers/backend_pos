<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseApiController extends Controller
{
    /**
     * Display a listing of all expenses.
     */
    public function index()
    {
        $expenses = Expense::with('category', 'transactionType')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Expenses retrieved successfully.',
            'data' => $expenses,
        ]);
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $validated['transaction_type_id'] = 9;

        $expense = Expense::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Expense created successfully.',
            'data' => $expense->load('category'),
        ], 201);
    }

    /**
     * Display the specified expense.
     */
    public function show(Expense $expense)
    {
        $expense->load('category', 'transactionType');

        return response()->json([
            'status' => true,
            'message' => 'Expense retrieved successfully.',
            'data' => $expense,
        ]);
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $expense->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Expense updated successfully.',
            'data' => $expense->load('category'),
        ]);
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->json([
            'status' => true,
            'message' => 'Expense deleted successfully.',
        ]);
    }
}
