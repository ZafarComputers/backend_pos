<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosInvoiceDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'product_id'   => $this->product_id,
            'product_name' => optional($this->product)->title,
            'qty'          => $this->qty,
            'sale_price'   => $this->sale_price,
            'discount'     => $this->discount,
            'amount'       => $this->qty * $this->sale_price,
        ];
    }
}
