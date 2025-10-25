<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosResource extends JsonResource
{
    public function toArray($request)
    {
          // Start with basic fields
        $data = [
            'inv_id'       => $this->id,
            'inv_date'     => $this->inv_date,
            'customer_id'  => $this->customer_id,
            'customer_name'=> optional($this->customer)->name,
            'inv_amount'   => $this->inv_amount,
            'paid_amount'  => $this->paid,
            'tax'          => $this->tax,
            'discPer'      => $this->discPer,
            'discAmount'   => $this->discAmount,
            
            // 'payment_mode'  => match ($this->payment_mode_id) {
                //     1 => 'Cash',
                //     2 => 'Bank',
                //     default => 'Credit',
                // },
            // 'payment_mode' => $this->paymentMode ? $this->paymentMode->mode_name : null,
            // 'transaction_type_id' => $this->transaction_type_id,
            'BankName'  => match ($this->payment_mode_id) {
                // 2 => optional($this->transactions->first()?->coa)->title,
                2 => $this->transactions->pluck('coa.title')->filter()->implode(', '),
                default => '',
            },
            // 'transaction_type_id' => $this->transaction_type_id,
            // transactionType
            'transaction_type' => $this->transactionType ? $this->transactionType->transType : null,

            

            'salesman'    => $this->employee ? $this->employee->first_name . " " .$this->employee->last_name  : null,

            // 'note'         => $this->note,
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
