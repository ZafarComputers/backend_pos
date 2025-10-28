<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosNoDtlResource extends JsonResource
{
    public function toArray($request)
    {        
        // Start with basic fields
        $data = [
            'inv_id'       => $this->id,
            'inv_date'     => $this->inv_date,
            'customer_id'  => $this->customer_id,
            'customer_name'=> optional($this->customer)->name,
            'description'  => $this->description,
            // 'tax'          => $this->tax,
            // 'discPer'      => $this->discPer,
            // 'discAmount'   => $this->discAmount,
            'inv_amount'   => $this->inv_amount,
            'paid_amount'         => $this->paid,
            'payment_mode' => $this->paymentMode->mode_name ?? null,

            // 'BankName1' => $this->payment_mode_id == 2
            //     ? optional($this->transactions->first()?->coa)->title
            //     : '',
            'BankName'  => match ($this->payment_mode_id) {
                // 2 => optional($this->transactions->first()?->coa)->title,
                2 => $this->transactions->pluck('coa.title')->filter()->implode(', '),
                default => '',
            },
            // 'transaction_type_id' => $this->transaction_type_id,
            // transactionType
            'transaction_type' => $this->transactionType ? $this->transactionType->transType : null,

            // 'created_at'   => $this->created_at,
            // 'updated_at'   => $this->updated_at,
            'salesman'    => $this->employee ? $this->employee->first_name . " " .$this->employee->last_name  : null,

        ];

        // Add bank info only when payment mode is 'Bank'
        if ($this->payment_mode === 'Bank' && $this->bankDetail) {
            $data['bank_detail'] = [
                'bank_name'      => $this->bankDetail->bank_name,
                'account_number' => $this->bankDetail->account_number,
            ];
        }

        return $data;

    }
}
