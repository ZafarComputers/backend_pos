<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Resources\IncomeResource;

class IncomeApiController extends Controller
{
    public function index()
    {
        $incomes = Income::with('incomeCategory')->latest()->get();
        return response()->json([
            'status' => true,
            'data' => IncomeResource::collection($incomes)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'transaction_type_id' => 'required|integer|exists:transaction_types,id',
            'date' => 'required|date',
            'incm_cat_name' => 'required|string|max:250',
            'income_category_id' => 'required|integer|exists:income_categories,id',
            'notes' => 'nullable|string|max:500',
            'amount' => 'required|numeric|min:0',
        ]);

        $income = Income::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Income created successfully.',
            'data' => new IncomeResource($income->load('incomeCategory'))
        ]);
    }

    public function show(Income $income)
    {
        return response()->json([
            'status' => true,
            'data' => new IncomeResource($income->load('incomeCategory'))
        ]);
    }

    public function update(Request $request, Income $income)
    {
        $data = $request->validate([
            'transaction_type_id' => 'required|integer|exists:transaction_types,id',
            'date' => 'required|date',
            'income_category_id' => 'required|integer|exists:income_categories,id',
            'incm_cat_name' => 'required|string|max:250',
            'notes' => 'nullable|string|max:500',
            'amount' => 'required|numeric|min:0',
        ]);

        $income->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Income updated successfully.',
            'data' => new IncomeResource($income->load('incomeCategory'))
        ]);
    }

    public function destroy(Income $income)
    {
        $income->delete();

        return response()->json([
            'status' => true,
            'message' => 'Income deleted successfully.'
        ]);
    }
}
