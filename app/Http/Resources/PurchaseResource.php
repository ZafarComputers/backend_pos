<?php


// app/Http/Resources/PurchaseResource.php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'Pur_Inv_id'     => $this->id,
            'pur_inv_barcode'=> $this->pur_inv_barcode,
            'pur_date'       => $this->pur_date,
            'vendor_id'      => $this->vendor_id,
            'vendorName'     => $this->vendor->first_name ." " .$this->vendor->last_name,
            'ven_inv_no'     => $this->ven_inv_no,
            'ven_inv_date'   => $this->ven_inv_date,
            'ven_inv_ref'    => $this->ven_inv_ref,
            'description'    => $this->description,
            'invDiscPer'=> $this->discount_percent,
            'invDiscAmount'   => $this->discount_amt,
            'inv_amount'     => $this->inv_amount,
            'payment_status' => $this->payment_status,
            'created_at'     => $this->created_at?->format('Y-m-d H:i:s'),
            'PurDetails'        => PurchaseDetailResource::collection($this->whenLoaded('details')),
            // 'PurDetails'        => PurchaseDetailResource::collection($this->whenLoaded('details.product')),
            // 'updated_at'     => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
