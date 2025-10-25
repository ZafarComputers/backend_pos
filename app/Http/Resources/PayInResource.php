<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayInResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'amount' => $this->amount,
            'naration' => $this->naration,
            'description' => $this->description,
            
            'transaction_type' => [
                'id' => $this->transactionType?->id,
                'name' => $this->transactionType?->transType,
                'code' => $this->transactionType?->code,
            ],

            'coa' => [
                'id' => $this->coa?->id,
                'title' => $this->coa?->title,
            ],

            'payment_mode' => [
                'id' => $this->paymentMode?->id,
                'name' => $this->paymentMode?->mode_name,
            ],

            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->first_name ." ". $this->user?->last_name,
            ],

            // 'expense' => $this->expense ? [
            //     'id' => $this->expense->id,
            //     'name' => $this->expense->name,
            //     'amount' => $this->expense->amount,
            //     'description' => $this->expense->description,
            //     'date' => $this->expense->date,
            // ] : null,

            'transactions' => $this->transactions->map(function ($t) {
                return [
                    'id' => $t->id,
                    'date' => $t->date,
                    'description' => $t->description,
                    'coas_id' => $t->coas_id,
                    'debit' => $t->debit,
                    'credit' => $t->credit,
                ];
            }),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
