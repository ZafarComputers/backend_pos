<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosReturnDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $this->product->title ?? null,
            'qty' => $this->qty,
            'return_unit_price' => $this->return_unit_price,
            'total' => $this->qty * $this->return_unit_price,
        ];
    }
}
