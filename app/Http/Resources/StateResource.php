<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'status'  => $this->status,
            'country' => new CountryResource($this->whenLoaded('country')),
        ];
    }
}
