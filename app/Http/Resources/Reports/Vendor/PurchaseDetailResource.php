<?php

namespace App\Http\Resources\Reports\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'productName' => $this->product->title,
            'quantity' => $this->qty,
            'price'    => $this->unit_price,
        ];
    }
}
