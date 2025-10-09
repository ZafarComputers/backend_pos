<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SalesReportResource;
use Illuminate\Http\Request;
use App\Models\Pos;
use App\Models\PosDetail;
use App\Models\Product;

class SalesRepApiController extends Controller
{
    public function getSalesReport(Request $request)
    {
        $sales = Pos::with([
            'posDetails.product.vendor:id,first_name',
            'posDetails.product.subCategory:id,title',
        ])
        ->select('id')
        ->get()
        ->flatMap(function ($invoice) {
            return $invoice->posDetails->map(function ($detail) use ($invoice) {
                return [
                    'pos_inv_no' => $invoice->id,
                    'product_name' => $detail->product->title ?? null,
                    'vendor' => $detail->product->vendor->first_name ?? null,
                    'category' => $detail->product->category->title ?? null,
                    'qty' => $detail->qty,
                    'sale_price' => $detail->sale_price,
                    'amount' => $detail->sale_price * $detail->qty,
                    'opening_stock_qty' => $detail->product->opening_stock_quantity,
                    'new_stock_qty' => $detail->product->stock_in_quantity,
                    'sold_stock_qty' => $detail->product->stock_out_quantity,
                    'instock_qty' => $detail->product->in_stock_quantity,
                ];
            });
        });

        return response()->json([
            'status' => true,
            'data' => SalesReportResource::collection($sales->values()),
        ]);
    }
 

    public function bestSellingProducts()
    {
        // Step 1: Aggregate sales data (total sold & revenue)
        $bestSelling = PosDetail::selectRaw('product_id, SUM(qty) as total_sold, SUM(qty * sale_price) as total_revenue')
            ->groupBy('product_id')
            ->orderByDesc('total_sold') // 🔹 Arrange by total_sold descending
            ->take(10)                  // Optional: Top 10 best sellers
            ->get();

        // Step 2: Load related products
        $products = Product::whereIn('id', $bestSelling->pluck('product_id'))
            ->with('vendor')
            ->get()
            ->map(function ($product) use ($bestSelling) {
                $record = $bestSelling->firstWhere('product_id', $product->id);
                $product->total_sold = $record->total_sold;
                $product->total_revenue = $record->total_revenue;
                return $product;
            });

        // Step 3: Sort again after mapping (to ensure final order)
        $sortedProducts = $products->sortByDesc('total_sold')->values();

        // Step 4: Return with resource
        return ProductResource::collection($sortedProducts);
    }

}