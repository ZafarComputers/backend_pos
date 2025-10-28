<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosWithExtrasResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            // POS Info - printed ONCE
            'invoice' => [
                'InvId'       => $this->id,
                'InvDate'     => $this->inv_date,
                'Customer'    => $this->customer?->name,
                'Description' => $this->description,
            ],

            // All Extras - repeated
            'extras' => PosExtraResource::collection($this->whenLoaded('extras')),
        ];
    }
}