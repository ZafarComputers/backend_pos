<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'pos_inv_no' => $this->resource['pos_inv_no'],
            'product_name' => $this->resource['product_name'],
            'vendor' => $this->resource['vendor'],
            'category' => $this->resource['category'],
            'qty' => $this->resource['qty'],
            'sale_price' => $this->resource['sale_price'],
            'amount' => $this->resource['amount'],
            'opening_stock_qty' => $this->resource['opening_stock_qty'],
            'new_stock_qty' => $this->resource['new_stock_qty'],
            'sold_stock_qty' => $this->resource['sold_stock_qty'],
            'instock_qty' => $this->resource['instock_qty'],
        ];
    }
}