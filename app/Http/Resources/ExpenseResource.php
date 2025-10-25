<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'date'        => $this->date,
            'amount'      => $this->amount,

            // ✅ "category" now shows CoA data instead of ExpenseCategory
            'category' => [
                'id'    => $this->coa?->id ?? $this->category?->id,
                'title' => $this->coa?->title ?? $this->category?->name,
                'code'  => $this->coa?->code ?? null,
            ],

            'transaction_type' => [
                'id'        => $this->transactionType?->id,
                'transType' => $this->transactionType?->transType,
                'code'      => $this->transactionType?->code,
            ],

            'payment_mode' => [
                'id'        => $this->paymentMode?->id,
                'mode_name' => $this->paymentMode?->mode_name,
            ],

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
