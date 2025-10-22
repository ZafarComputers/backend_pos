<?php

namespace App\Http\Resources\FinanceAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class CashFlowResource2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'date' => $this->date,
            'transaction_type' => $this->transaction_type,
            'description' => $this->description,
            'debit' => number_format($this->debit, 2),
            'credit' => number_format($this->credit, 2),
            'balance' => number_format($this->balance, 2),
            'payment_source' => $this->payment_source,
        ];
    }
}
