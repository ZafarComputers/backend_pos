<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'purchase_id' => $this->purchase_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'unit_price' => $this->unit_price,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,

            // optional if you want product name too
            'product' => $this->whenLoaded('product'),
        ];
    }
}
