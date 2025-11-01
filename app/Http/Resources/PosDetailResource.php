<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosDetailResource extends JsonResource
{
    public function toArray($request)
    {
        $subtotal = $this->qty * $this->sale_price;
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $this->product?->title, // ✅ null-safe
            'quantity' => $this->qty,
            'price' => $this->sale_price,
            'subtotal' => $subtotal,
            'bal_stock' => $this->product?->in_stock_quantity

            // $data['extras'] = PosExtraResource::collection($this->whenLoaded('extras'));

        
            // 'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // 'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),   
        ];
    }
}
