<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosNoDtlResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'Inv_id' => $this->id,
            'InvDate' => $this->inv_date,
            'customer_name' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'inv_amount' => $this->inv_amount,
            'paid_amount' => $this->paid,
            // 'details' => PosDetailResource::collection($this->whenLoaded('details')),
         
            // 'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // 'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

        ];
    }
}
