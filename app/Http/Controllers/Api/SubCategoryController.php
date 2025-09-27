<?php

// app/Http/Controllers/Api/SubCategoryController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index() {
        return SubCategory::with('category')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string',
            'img_path' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Active,Inactive',
        ]);
        return SubCategory::create($data);
    }

    public function show(SubCategory $subcategory) {
        return $subcategory->load('category');
    }

    public function update(Request $request, SubCategory $subcategory) {
        $data = $request->validate([
            'title' => 'required|string',
            'img_path' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Active,Inactive',
        ]);
        $subcategory->update($data);
        return $subcategory;
    }

    public function destroy(SubCategory $subcategory) {
        $subcategory->delete();
        return response()->json(['message' => 'SubCategory deleted']);
    }
}
