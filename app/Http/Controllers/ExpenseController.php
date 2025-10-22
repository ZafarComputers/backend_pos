<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('category')->latest()->paginate(10);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = ExpenseCategory::where('status', 'Active')->get();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $data['transaction_type_id'] = 9;

        Expense::create($data);
        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::where('status', 'Active')->get();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $expense->update($data);
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
