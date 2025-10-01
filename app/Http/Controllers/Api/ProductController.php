<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * GET /api/products
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);

        $products = Product::with(['subCategory', 'user'])
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        // Returns a paginated resource collection (includes pagination meta)
        return ProductResource::collection($products);
    }

    /**
     * POST /api/products
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'design_code' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:1024',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sale_price' => 'required|numeric|min:0',
            'opening_stock_quantity' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'barcode' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $product = Product::create($data);

        return (new ProductResource($product->load(['subCategory', 'user'])))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * GET /api/products/{product}
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load(['subCategory', 'user']));
    }

    /**
     * PUT/PATCH /api/products/{product}
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'design_code' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:1024',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sale_price' => 'required|numeric|min:0',
            'opening_stock_quantity' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'barcode' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $product->update($data);

        return new ProductResource($product->load(['subCategory', 'user']));
    }

    /**
     * DELETE /api/products/{product}
     */
    public function destroy(Product $product)
    {
        $product->delete();

        // No content
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
