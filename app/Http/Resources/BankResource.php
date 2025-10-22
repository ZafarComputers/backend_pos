<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'transaction_type' => $this->transactionType?->transType,
            'acc_holder_name' => $this->acc_holder_name,
            'acc_no' => $this->acc_no,
            'acc_type' => $this->acc_type,
            'op_balance' => $this->op_balance,
            'note' => $this->note,
            'status' => $this->status,
        ];
    }
}
