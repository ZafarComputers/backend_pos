<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseReturnDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'purchase_return_id' => $this->purchase_return_id,
            'product_id' => $this->product_id,
            'product_id' => $this->product->title,
 
            // 'product' => $this->whenLoaded('product'),
            'qty' => $this->qty,
            'unit_price' => $this->unit_price,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,
        ];
    }
}
