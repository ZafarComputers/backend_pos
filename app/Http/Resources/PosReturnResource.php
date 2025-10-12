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
            'id' => $this->id,
            'invRet_date' => $this->invRet_date,
            'return_inv_amout' => $this->return_inv_amout,

            'pos_id' => $this->pos_id,
            // 'pos_invoice' => $this->pos ? $this->pos->inv_no ?? null : null,

            'customer' => [
                'id' => $this->customer->id ?? null,
                'name' => $this->customer->name ?? null,
            ],

            'details' => PosReturnDetailResource::collection($this->whenLoaded('details')),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
