<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryApiController extends Controller
{
    /**
     * Display a listing of all expense categories.
     */
    public function index()
    {
        $categories = ExpenseCategory::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Expense Categories retrieved successfully.',
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created expense category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $category = ExpenseCategory::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Expense Category created successfully.',
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified expense category.
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        return response()->json([
            'status' => true,
            'message' => 'Expense Category retrieved successfully.',
            'data' => $expenseCategory,
        ]);
    }

    /**
     * Update the specified expense category in storage.
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $expenseCategory->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Expense Category updated successfully.',
            'data' => $expenseCategory,
        ]);
    }

    /**
     * Remove the specified expense category from storage.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();

        return response()->json([
            'status' => true,
            'message' => 'Expense Category deleted successfully.',
        ]);
    }
}
