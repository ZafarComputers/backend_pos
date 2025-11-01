<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosReturnDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'sku' => $this->product->sku ?? null,
            ],
            'qty' => $this->qty,
            'return_unit_price' => $this->return_unit_price,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,
        ];
    }
}
