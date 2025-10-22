<?php

namespace App\Http\Resources\Reports\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'barcode' => $this->pur_inv_barcode,
            'invoice_no'  => $this->ven_inv_no,
            'Inv_date'        => $this->ven_inv_date,
            'total'       => $this->inv_amount,
            'details'     => PurchaseDetailResource::collection($this->whenLoaded('details')),
        ];
    }
}
