<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'transaction_type_id' => $this->transaction_type_id,
            'coas_id' => $this->coas_id,
            'coaRef_id' => $this->coaRef_id,
            'users_id' => $this->users_id,
            'description' => $this->description,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'coa' => [
                'id' => $this->coa?->id,
                'title' => $this->coa?->title,
                'code' => $this->coa?->code,
            ],
            'coaRef' => [
                'id' => $this->coaRef?->id,
                'title' => $this->coaRef?->title,
                'code' => $this->coaRef?->code,
            ],
        ];
    }
}
