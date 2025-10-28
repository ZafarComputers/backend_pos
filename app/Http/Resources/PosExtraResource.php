<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosExtraResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            // 'InvId'       => $this->pos->id,
            // 'InvDate'     => $this->pos->inv_date,
            // 'Customer'    => $this->pos->customer->name,
            // 'Description' => $this->pos->description,
            
            'id'          => $this->id,
            'pos_id'      => $this->pos_id,
            'title'       => $this->title,
            'value'       => $this->value,
            'amount'      => $this->amount,
            'created_at'  => $this->created_at?->toDateTimeString(),
            // 'updated_at'  => $this->updated_at?->toDateTimeString(),
        ];
    }
}