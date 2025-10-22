<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosResource extends JsonResource
{
    public function toArray($request)
    {
          // Start with basic fields
        $data = [
            'inv_id'           => $this->id,
            'inv_date'     => $this->inv_date,
            'customer_id'  => $this->customer_id,
            'customer_name'=> optional($this->customer)->name,
            'inv_amount'   => $this->inv_amount,
            'paid_amount'         => $this->paid,
            'payment_mode' => $this->payment_mode,
        ];
        
        // Add bank info only when payment mode is 'Bank'
        if ($this->payment_mode === 'Bank' && $this->bankDetail) {
            $data['bank_detail'] = [
                'bank_name'      => $this->bankDetail->bank_name,
                'account_number' => $this->bankDetail->account_number,
            ];
        }
        
        // Include POS item details (products, qty, price, etc.)
        $data['details'] = PosDetailResource::collection($this->whenLoaded('details'));
        
        return $data;
        
        // 'details' => PosDetailResource::collection($this->whenLoaded('details')),
        
    }
}
