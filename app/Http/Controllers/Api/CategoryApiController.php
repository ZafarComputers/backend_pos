<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

// Resources
use App\Http\Resources\CategoryResource;

// Models
use App\Models\Category;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request) 
    {
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



    // for Category Image retrieval
    public function getImage($filename)
    {
        // filename now can include folder e.g. "category/cat01.jpeg"
        $path = storage_path('app/' . $filename);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        return response()->file($path);
    }


    /**
     * Store a newly created category.
    */
    public function store(Request $request)
    {
        // dd($request->all(), $request->file('img_path'));
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:255|unique:categories,title',
            'img_path'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'    => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Handle image upload if provided
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store in storage/app/category
            // $path = $image->storeAs('category', $filename); 
            // $data['img_path'] = $path; // save relative path
            $path = $image->store('category', 'public');
            $data['img_path'] = $path; // "category/cat01.jpeg"
        }




        $category = Category::create($data);

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
