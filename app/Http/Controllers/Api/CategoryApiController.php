<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        // dd('You are here: ', $request);
        $withSubcategories = $request->boolean('with_subcategories', false);

        $categories = Category::when($withSubcategories, function ($query) {
            $query->with('subcategories');
        })->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Category list retrieved successfully.',
            'data' => CategoryResource::collection($categories),
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:255|unique:categories,title',
            'img_path'  => 'nullable|string',
            'status'    => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $category = Category::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data'    => new CategoryResource($category),
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $category->load('subcategories');

        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully.',
            'data' => new CategoryResource($category),
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'title'    => 'required|string|max:255|unique:categories,title,' . $category->id,
            'img_path' => 'nullable|file|image|max:2048', // Optional file validation
            'status'   => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Handle image file if uploaded
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $path = $image->store('categories', 'public');
            $data['img_path'] = $path;

            // Optional: delete old image
            if ($category->img_path && \Storage::disk('public')->exists($category->img_path)) {
                \Storage::disk('public')->delete($category->img_path);
            }
        }

        // Update the category
        $category->update($data);

        // Return JSON response using CategoryResource
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data'    => new CategoryResource($category),
        ]);
    }



    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }
}
