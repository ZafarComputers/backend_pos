<?php

// app/Http/Controllers/Api/CategoryController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|unique:categories',
            'img_path' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        return Category::create($data);
    }

    public function show(Category $category) {
        return $category;
    }

    public function update(Request $request, Category $category) {
        $data = $request->validate([
            'title' => 'required|string|unique:categories,title,' . $category->id,
            'img_path' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $category->update($data);
        return $category;
    }

    public function destroy(Category $category) {
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
