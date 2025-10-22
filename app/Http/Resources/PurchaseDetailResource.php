<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            // 'purchase_id' => $this->purchase_id,
            'product_id' => $this->product_id,
            'productName' => $this->product->title,
            // 'product' => $this->whenLoaded('product'),
            // 'categoryName' => $this->whenLoaded('product'),
            // 'category' => $this->whenLoaded('product'),
            'quantity' => $this->qty,
            'unit_price' => $this->unit_price,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,
            // 'amount' => ($this->qty * $this->unit_price) - $this->discAmount,
            'amount' => number_format(($this->qty * $this->unit_price) - $this->discAmount, 2, '.', ''),


            // optional if you want product name too
        ];
    }
}
