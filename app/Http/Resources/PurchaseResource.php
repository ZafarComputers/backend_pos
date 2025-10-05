<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pur_date' => $this->pur_date,
            'pur_inv_barcode' => $this->pur_inv_barcode,
            'vendor_id' => $this->vendor_id,
            'ven_inv_no' => $this->ven_inv_no,
            'ven_inv_date' => $this->ven_inv_date,
            'ven_inv_ref' => $this->ven_inv_ref,
            'description' => $this->description,
            'discount_percent' => $this->discount_percent,
            'discount_amt' => $this->discount_amt,
            'inv_amount' => $this->inv_amount,

            'payment_status' => $this->payment_status,  // ✅ added

            // ✅ include purchase details with resource
            'details' => PurchaseDetailResource::collection($this->whenLoaded('details')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
