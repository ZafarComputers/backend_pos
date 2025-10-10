<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

// Resources
use App\Http\Resources\ProductResource;
use App\Http\Resources\SalesReportResource;
use App\Http\Resources\PurchaseResource;

use App\Http\Resources\Reports\Inventory\InventoryHistoryResources;
use App\Http\Resources\Reports\Inventory\InventorySoldResources;
use App\Http\Resources\Reports\Inventory\InvtInhandResources;
use App\Http\Resources\Reports\Vendor\VendorResource;
use App\Http\Resources\Reports\Vendor\VendorDuesResource;




// Models
use Illuminate\Http\Request;
use App\Models\Pos;
use App\Models\PosDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Vendor;




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

    // GET all purchases Report with details
    public function getPurReport(Request $request)
    {
        $query = Purchase::with('vendor', 'details.product', 'details.product.category');

        if ($request->filled('payment_status')) {
            $status = strtolower($request->query('payment_status'));

            // Make sure only valid values are allowed
            if (in_array($status, ['paid', 'unpaid', 'overdue'])) {
                $query->where('payment_status', $status);
            }
        }

        return PurchaseResource::collection($query->get());
    }

    // Inventory Reports - (Get Inventory in Hand)
    public function getInventory(Request $request)
    {
        // return response()->json("message: getInventory");

            $inventory = Product::with(['subCategory', 'vendor'])
            ->where('in_stock_quantity', '!=', 0)
            ->get();

        return InvtInhandResources::collection($inventory);
    }

    // Inventory Reports - (Get Inventory History:=> Opening,in,out,bal )
    public function getInventoryHistory(Request $request)
    {
        // return response()->json("message: getInventoryHistory");
        $inventoryHistory = Product::with(['subCategory', 'vendor'])->get();

        return InventoryHistoryResources::collection($inventoryHistory);
    }

    // Inventory Reports - (Get Inventory Sold)
    public function getInventorySold(Request $request)
    {
        $inventorySold = Product::with(['subCategory', 'vendor'])
            ->where('stock_out_quantity', '!=', 0)
            ->get();

        return InventorySoldResources::collection($inventorySold);
    }

    // Vendor's Reports
    public function getVendorPurchases()
    {
        $vendors = Vendor::with('purchases.details')->get();
        return VendorResource::collection($vendors);
    }

    public function getVendorDues()
    {
        // Get all vendors with their purchases
        $vendors = Vendor::with('purchases')->get();
        
        
        // $vendors = Vendor::with(['purchases' => function ($query) use ($request) {
        //     if ($request->has(['from', 'to'])) {
        //         $query->whereBetween('purchase_date', [$request->from, $request->to]);
        //     }
        // }])->get();

        // // Only vendors who still owe money
        // $vendors = $vendors->filter(function ($vendor) {
        //     return $vendor->purchases->sum('total_amount') > $vendor->purchases->sum('paid_amount');
        // });
        
        return VendorDuesResource::collection($vendors);

    }

}