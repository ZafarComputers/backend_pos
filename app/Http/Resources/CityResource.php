<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'city'   => $this->title,
            'state'   => $this->state->title,
            'country' => $this->state->country->title,
            'status'  => $this->status,

            // 'state'   => new StateResource($this->whenLoaded('state')),
        ];
    }
}
