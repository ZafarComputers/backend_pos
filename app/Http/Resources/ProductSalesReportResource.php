<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSalesReportResource extends JsonResource
{
    public function toArray($request)
    {
        $product = $this->product;
        return [
            'id'              => $product?->id,
            // 'date'            => optional($this->pos)->inv_date,
            'product_name'    => $product?->title,
            'vendor_name'     => optional($product?->vendor)->first_name ." " .optional($product?->vendor)->last_name,
            'category_name'   => optional($product?->category)->title,
            'sold_quantity'   => $this->total_sold_qty,
            'in_stock_qty'    => $product?->qty ?? 0, // assuming your products table has 'qty' column
        ];
    }
}
