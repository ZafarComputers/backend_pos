<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use App\Http\Resources\IncomeCategoryResource;

class IncomeCategoryApiController extends Controller
{
    public function index()
    {
        $categories = IncomeCategory::latest()->get();
        return response()->json([
            'status' => true,
            'data' => IncomeCategoryResource::collection($categories)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'income_category' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $category = IncomeCategory::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Income Category created successfully.',
            'data' => new IncomeCategoryResource($category)
        ]);
    }

    public function show(IncomeCategory $incomeCategory)
    {
        return response()->json([
            'status' => true,
            'data' => new IncomeCategoryResource($incomeCategory)
        ]);
    }

    public function update(Request $request, IncomeCategory $incomeCategory)
    {
        $data = $request->validate([
            'income_category' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $incomeCategory->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Income Category updated successfully.',
            'data' => new IncomeCategoryResource($incomeCategory)
        ]);
    }

    public function destroy(IncomeCategory $incomeCategory)
    {
        $incomeCategory->delete();

        return response()->json([
            'status' => true,
            'message' => 'Income Category deleted successfully.'
        ]);
    }
}
