<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryApiController extends Controller
{
    /**
     * Display a listing of all subcategories.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->get();

        return response()->json([
            'status'  => true,
            'message' => 'Subcategories fetched successfully.',
            'data'    => SubCategoryResource::collection($subCategories),
        ]);
    }

    /**
     * Store a newly created subcategory.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'img_path'    => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->only(['title', 'category_id', 'status']);

        // Handle image upload if file provided
        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('subcategories', 'public');
        }

        $subCategory = SubCategory::create($data);

        return response()->json([
            'status'  => true,
            'message' => 'Subcategory created successfully.',
            'data'    => new SubCategoryResource($subCategory),
        ], 201);
    }

    /**
     * Display the specified subcategory.
     */
    // public function show(SubCategory $subCategory)
    public function show($id)
    {
        // Find subcategory with its related category
        $subCategory = SubCategory::with('category')->find($id);

        if (!$subCategory) {
            return response()->json([
                'status'  => false,
                'message' => 'Subcategory not found.'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Subcategory details fetched successfully.',
            'data'    => new SubCategoryResource($subCategory)
        ], 200);
    }


    /**
     * Update the specified subcategory.
     */
    public function update(Request $request, $id)
    {
        // Find subcategory
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json([
                'status'  => false,
                'message' => 'Subcategory not found.'
            ], 404);
        }

        // Validate input
        $validator = Validator::make($request->all(), [
            'title'       => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            // 'img_path'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_path'    => 'nullable|string|max:255',
            'status'      => 'sometimes|required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['title', 'category_id', 'status']);

        // Handle image upload
        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('subcategories', 'public');
        }

        // Update the subcategory
        $subCategory->update($data);

        // Load related category for response
        $subCategory->load('category');

        return response()->json([
            'status'  => true,
            'message' => 'Subcategory updated successfully.',
            'data'    => new SubCategoryResource($subCategory)
        ], 200);
    }

    // /**
    //  * Remove the specified subcategory from storage.
    //  */
    // public function destroy(SubCategory $subCategory)
    // {
    //     $subCategory->delete();

    //     return response()->json([
    //         'status'  => true,
    //         'message' => 'Subcategory deleted successfully.',
    //     ]);
    // }

    /**
     * Remove the specified subcategory from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Subcategory deleted successfully.',
        ], 200);
    }


}
