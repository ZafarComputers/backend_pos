<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashFlowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'bank' => $this->bank_info, // from CONCAT(bank_name, account_no)
            'description' => $this->description,
            'debit' => (float) $this->debit,
            'credit' => (float) $this->credit,
            'balance' => (float) $this->balance,
            'payment_mode' => $this->payment_mode,
        ];
    }
}
