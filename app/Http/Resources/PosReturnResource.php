<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosReturnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request)
    {
        return [
            'return_id' => $this->id,
            'customerName' => $this->customer->name ?? null,
            'pos_id' => $this->pos_id,
            'invRet_date' => $this->invRet_date,
            'reason'   => $this->reason,
            'return_inv_amount' => $this->return_inv_amount,
            'tax' => $this->tax,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,
            'paid' => $this->paid, 
            'transaction_type_id' =>$this->transaction_type_id , // ✅ new column
            'payment_mode_id' => $this->payment_mode_id , // ✅ new column

            'details' => PosReturnDetailResource::collection($this->whenLoaded('details')),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}