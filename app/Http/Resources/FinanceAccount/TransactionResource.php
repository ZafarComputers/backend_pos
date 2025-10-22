<?php

namespace App\Http\Resources\FinanceAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            // 'transaction_types_id' => $this->transaction_types_id,
            // 'invType' => $this->transactionType->code ?? null,
            // 'invRef_id' => $this->invRef_id,
             'inv_ref' => ($this->transactionType->code ?? 'N/A') . '-' . $this->invRef_id,
            'coas_id' => $this->coas_id,
            'coaRef_id' => $this->coaRef_id,
            'users_id' => $this->users_id,
            'description' => $this->description,
            'debit' => $this->debit,
            'credit' => $this->credit,
        ];
    }
}
