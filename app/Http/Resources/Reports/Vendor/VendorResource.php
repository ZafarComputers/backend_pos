<?php

namespace App\Http\Resources\Reports\Vendor;

use App\Http\Resources\Reports\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'vendorName'     => $this->first_name ." " . $this->last_name,
            // 'name'     => $this->first_name,
            // 'email'    => $this->email,
            // 'phone'    => $this->phone,
            'purchases' => PurchaseResource::collection($this->whenLoaded('purchases')),
        ];
    }
}
