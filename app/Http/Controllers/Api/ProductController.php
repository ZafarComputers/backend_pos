<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * GET /api/products
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);

        $products = Product::with(['subCategory', 'user', 'vendor', 'colors', 'sizes', 'seasons', 'materials'])
            ->latest()
            ->paginate($perPage);

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created product.
     *
     * POST /api/products
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        DB::beginTransaction();

        try {
            $product = Product::create($validated);

            $this->syncRelations($product, $request);

            DB::commit();

            return (new ProductResource(
                $product->load(['subCategory', 'user', 'vendor', 'colors', 'sizes', 'seasons', 'materials'])
            ))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create product',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified product.
     *
     * GET /api/products/{product}
     */
    public function show(Product $product)
    {
        $product->load(['subCategory', 'user', 'vendor', 'colors', 'sizes', 'seasons', 'materials']);

        return new ProductResource($product);
    }

    /**
     * Update the specified product.
     *
     * PUT/PATCH /api/products/{product}
     */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product->id);

        DB::beginTransaction();

        try {
            $product->update($validated);

            $this->syncRelations($product, $request);

            DB::commit();

            return new ProductResource(
                $product->load(['subCategory', 'user', 'vendor', 'colors', 'sizes', 'seasons', 'materials'])
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Failed to update product',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified product.
     *
     * DELETE /api/products/{product}
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Product deleted successfully',
        ], 200);
    }

    /**
     * Display a list of low-stock products.
     *
     * GET /api/products/low-stock
     */
    public function lowStock(Request $request)
    {
        $threshold = (int) $request->query('threshold', 10);

        $products = Product::where('opening_stock_quantity', '<=', $threshold)
            ->with(['vendor', 'subCategory', 'user'])
            ->orderBy('opening_stock_quantity')
            ->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No low stock products found']);
        }

        return ProductResource::collection($products);
    }

    /**
     * Validate product request data.
     */
    protected function validateProduct(Request $request, $productId = null): array
    {
        return $request->validate([
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

            // Pivot relationships
            'colors'      => 'nullable|array',
            'colors.*'    => 'exists:colors,id',
            'sizes'       => 'nullable|array',
            'sizes.*'     => 'exists:sizes,id',
            'seasons'     => 'nullable|array',
            'seasons.*'   => 'exists:seasons,id',
            'materials'   => 'nullable|array',
            'materials.*' => 'exists:materials,id',
        ]);
    }

    /**
     * Sync product relationships.
     */
    protected function syncRelations(Product $product, Request $request): void
    {
        $product->colors()->sync($request->input('colors', []));
        $product->sizes()->sync($request->input('sizes', []));
        $product->seasons()->sync($request->input('seasons', []));
        $product->materials()->sync($request->input('materials', []));
    }
}
