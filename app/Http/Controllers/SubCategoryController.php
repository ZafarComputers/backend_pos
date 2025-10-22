<?php

// app/Http/Controllers/SubCategoryController.php
namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index() {
        $subcategories = SubCategory::with('category')->paginate(10);
        return view('subcategories.index', compact('subcategories'));
    }

    public function create() {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'img_path' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        SubCategory::create($request->all());
        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully.');
    }

    public function show(SubCategory $subcategory) {
        return view('subcategories.show', compact('subcategory'));
    }

    public function edit(SubCategory $subcategory) {
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subcategory) {
        $request->validate([
            'title' => 'required|string',
            'img_path' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        $subcategory->update($request->all());
        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully.');
    }

    public function destroy(SubCategory $subcategory) {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully.');
    }
}
