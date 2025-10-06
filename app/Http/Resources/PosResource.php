<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'inv_date' => $this->inv_date,
            'inv_amount' => $this->inv_amount,
            'tax' => $this->tax,
            'discPer' => $this->discPer,
            'discount' => $this->discount,
            'pos_details' => PosDetailResource::collection($this->whenLoaded('posDetails')),
        ];
    }
}

class PosDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pos_id' => $this->pos_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'sale_price' => $this->sale_price,
        ];
    }
}