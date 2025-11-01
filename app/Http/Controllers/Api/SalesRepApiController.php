<?php

namespace App\Http\Controllers\Api;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


// Resources
use App\Http\Resources\ProductResource;
use App\Http\Resources\SalesReportResource;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\Reports\Inventory\InventoryHistoryResources;
use App\Http\Resources\Reports\Inventory\InventorySoldResources;
use App\Http\Resources\Reports\Inventory\InvtInhandResources;
use App\Http\Resources\Reports\Vendor\VendorResource;
use App\Http\Resources\Reports\Vendor\VendorDuesResource;
use App\Http\Resources\Reports\Expenses\ExpenseReportResource;
use App\Http\Resources\ProductSalesReportResource;


// Models
use App\Models\Pos;
use App\Models\PosDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\PayOut;
// use App\Models\Expense;


class SalesRepApiController extends Controller
{
    
    
    // public function getSalesReport(Request $request)
    public function getSalesReport(Request $request)
    {
        $query = Pos::with(['details.product', 'customer', 'employee'])->orderByDesc('inv_date');

        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('inv_date', [$request->from_date, $request->to_date]);
        }

        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        $invoices = $query->get();

        if ($invoices->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No sales invoices found for the given criteria.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sales invoice report retrieved successfully.',
            'data' => SalesReportResource::collection($invoices),
        ]);
    }

    // Products Sale Reprot
    public function getProductSalesRep(Request $request)
    {
        $query = PosDetail::select(
                'product_id',
                DB::raw('SUM(qty) as total_sold_qty'),
                DB::raw('MAX(pos_id) as last_pos_id')
            )
            ->groupBy('product_id')
            ->with([
                // ✅ Fully qualify columns to prevent ambiguity
                'product.category' => function ($q) {
                    $q->select('categories.id', 'categories.title');
                },
                'product.vendor' => function ($q) {
                    $q->select('vendors.id', 'vendors.first_name', 'vendors.last_name');
                },
                'pos:id,inv_date'
            ])
            ->orderByDesc('total_sold_qty');

        // ✅ Optional date filter
        if ($request->has(['from_date', 'to_date'])) {
            $query->whereHas('pos', function ($q) use ($request) {
                $q->whereBetween('inv_date', [$request->from_date, $request->to_date]);
            });
        }

        $report = $query->get();

        if ($report->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No product sales found for the given criteria.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product sales report retrieved successfully.',
            'data' => ProductSalesReportResource::collection($report),
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
    // public function getInventory(Request $request)
    // {
    //     // return response()->json("message: getInventory");

    //         $inventory = Product::with(['subCategory', 'vendor'])
    //         ->where('in_stock_quantity', '!=', 0)
    //         ->get();

    //     return InvtInhandResources::collection($inventory);
    // }
    public function getInventory(Request $request)
    {
        $inventory = Product::where('stock_in_quantity', '!=', 0)->get();
        return InvtInhandResources::collection($inventory);
    }


    // Inventory Reports - (Get Inventory History:=> Opening,in,out,bal )
    public function getInventoryHistory(Request $request)
    {
        $inventoryHistory = Product::get();
        return InventoryHistoryResources::collection($inventoryHistory);
    }

    // Inventory Reports - (Get Inventory Sold)
    public function getInventorySold(Request $request)
    {
        $inventory = Product::where('stock_out_quantity', '!=', 0)->get();
        return InventorySoldResources::collection($inventory);
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

    // Customer's Reports 1-2
    public function allCustomerInvoices()
    {
        $customers = Customer::with(['invoices' => function($query) {
            $query->select('id', 'customer_id', 'inv_date', 'inv_amount', 'paid', 'tax', 'discPer', 'discAmount');
        }])->get();

        return response()->json([
            'status' => true,
            'message' => 'All Customers Invoice Listing',
            'data' => $customers
        ]);
    }

    public function allCustomerDues()
    {
        $dues = Customer::select(
            'customers.id',
            'customers.name',
            DB::raw('COALESCE(SUM(pos.inv_amount),0) as total_invoice'),
            DB::raw('COALESCE(SUM(pos.paid),0) as total_paid'),
            DB::raw('COALESCE(SUM(pos.inv_amount - pos.paid),0) as total_due')
        )
        ->leftJoin('pos', 'pos.customer_id', '=', 'customers.id')
        ->groupBy('customers.id', 'customers.name')
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'All Customers Due Report',
            'data' => $dues
        ]);
    }

     /**
     * Generate an expense report.
     *
     * This returns a simplified list of expenses for reporting purposes.
     */
   public function expenseReport(Request $request)
    {
        // Use the correct model
        // $query = PayOut::with('category');
        // $query = PayOut::all();
        $query = PayOut::query();  // ✅ Correct way to start a query
        

        // Optional filters (date range or category)
        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        // if ($request->has('category_id')) {
        //     $query->where('expense_category_id', $request->category_id);
        // }

        $expenses = $query->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Expense report generated successfully.',
            'data' => ExpenseReportResource::collection($expenses),
        ]);
    }


}