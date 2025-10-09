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

        $products = Product::with(['subCategory', 'user', 'vendor'])
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        // Paginated resource collection
        return ProductResource::collection($products);
    }

    /**
     * POST /api/products
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                  => 'required|string|max:255',
            'design_code'            => 'nullable|string|max:255',
            'image_path'             => 'nullable|string|max:1024',
            'sub_category_id'        => 'required|exists:sub_categories,id',
            'sale_price'             => 'required|numeric|min:0',
            'opening_stock_quantity' => 'required|integer|min:0',
            'stock_in_quantity'      => 'required|integer|min:0',
            'stock_out_quantity'     => 'required|integer|min:0',
            'in_stock_quantity'      => 'required|integer|min:0',
            'user_id'                => 'required|exists:users,id',
            'vendor_id'              => 'required|exists:vendors,id',
            'barcode'                => 'nullable|string|max:255',
            'status'                 => 'required|in:Active,Inactive',
        ]);

        $product = Product::create($data);

        return (new ProductResource($product->load(['subCategory', 'user', 'vendor'])))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * GET /api/products/{product}
     */
    public function show($id)
    {
        $product = Product::with(['subCategory', 'user', 'vendor'])->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return new ProductResource($product);
    }

    /**
     * PUT/PATCH /api/products/{product}
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title'                  => 'required|string|max:255',
            'design_code'            => 'nullable|string|max:255',
            'image_path'             => 'nullable|string|max:1024',
            'sub_category_id'        => 'required|exists:sub_categories,id',
            'sale_price'             => 'required|numeric|min:0',
            'opening_stock_quantity' => 'required|integer|min:0',
            'stock_in_quantity'      => 'required|integer|min:0',
            'stock_out_quantity'     => 'required|integer|min:0',
            'in_stock_quantity'      => 'required|integer|min:0',
            'user_id'                => 'required|exists:users,id',
            'vendor_id'              => 'required|exists:vendors,id',
            'barcode'                => 'nullable|string|max:255',
            'qrcode'                 => 'nullable|string|max:255',
            'status'                 => 'required|in:Active,Inactive',
        ]);

        $product->update($data);

        return new ProductResource($product->load(['subCategory', 'user', 'vendor']));
    }

    /**
     * DELETE /api/products/{product}
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    // Low Stock Method
    public function lowStock(Request $request)
    {
        // Default threshold = 10, can override via query ?threshold=5
        $threshold = $request->query('threshold', 10);

        $products = Product::where('opening_stock_quantity', '<=', $threshold)
            ->with(['vendor', 'subCategory', 'user'])
            ->orderBy('opening_stock_quantity', 'asc')
            ->get();

            if ($products->isEmpty()) {
                    return response()->json([
                        'message' => 'No low stock products found'
                    ], 200);
                }

                return ProductResource::collection($products);
    }
}
