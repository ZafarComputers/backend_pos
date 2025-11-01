<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosReturnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'invRet_date' => $this->invRet_date,
            'customer' => [
                'id' => $this->customer?->id,
                'name' => $this->customer?->name,
            ],
            'employee' => [
                'id' => $this->employee?->id,
                'name' => $this->employee?->name,
            ],
            'transaction_type_id' => $this->transaction_type_id,
            'payment_mode_id' => $this->payment_mode_id,
            'tax' => $this->tax,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,
            'return_inv_amount' => $this->return_inv_amount,
            'paid' => $this->paid,
            'description' => $this->description,
            'details' => PosReturnDetailResource::collection($this->details ?? []),
            // 'details' => PosReturnDetailResource::collection($this->whenLoaded('details')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
