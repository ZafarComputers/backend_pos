<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'purchase_return_id' => $this->id,
            'return_date' => $this->return_date,
            'return_inv_no' => $this->return_inv_no,
            'reason' => $this->reason,
            'discount_percent' => $this->discount_percent,
            'return_amount' => $this->return_amount,
            'vendor' => new VendorResource($this->whenLoaded('vendor')),
            'purchase' => new PurchaseResource($this->whenLoaded('purchase')),
            'details' => PurchaseReturnDetailResource::collection($this->whenLoaded('details')),
   
        ];
    }
}
