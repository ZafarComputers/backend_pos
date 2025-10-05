<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'return_date' => $this->return_date,
            'return_inv_no' => $this->return_inv_no,
            'vendor_id' => $this->vendor_id,
            'reason' => $this->reason,
            'discount_percent' => $this->discount_percent,
            'discount_amt' => $this->discount_amt,
            'return_amount' => $this->return_amount,
            'payment_status' => $this->payment_status,
            'details' => PurchaseReturnDetailResource::collection($this->whenLoaded('details')),
            'created_at' => $this->created_at,
        ];
    }
}
