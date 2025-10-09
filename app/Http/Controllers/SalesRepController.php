<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PosInvoice;
use Illuminate\Http\Request;

class SalesRepController extends Controller
{
    public function getSalesReport(Request $request)
    {
        $sales = PosInvoice::with([
            'invoiceDetails.product.vendor:id,name',
            'invoiceDetails.product.category:id,name',
        ])
        ->select('id', 'pos_inv_no')
        ->get()
        ->flatMap(function ($invoice) {
            return $invoice->invoiceDetails->map(function ($detail) use ($invoice) {
                return [
                    'pos_inv_no'   => $invoice->pos_inv_no,
                    'product_name' => $detail->product->name ?? null,
                    'vendor'       => $detail->product->vendor->name ?? null,
                    'category'     => $detail->product->category->name ?? null,
                    'qty'          => $detail->qty,
                    'amount'       => $detail->amount,
                    'instock_qty'  => $detail->product->stock_qty ?? 0,
                ];
            });
        });

        return response()->json([
            'status' => true,
            'data' => $sales->values(),
        ]);
    }
}
