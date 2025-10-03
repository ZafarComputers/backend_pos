<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'first_name'=> $this->first_name,
            'last_name' => $this->last_name,
            'cnic'      => $this->cnic,
            'address' => $this->address ?? null,
            'city_id'   => $this->city_id,
            'email'   => $this->email ?? null,
            'phone'   => $this->phone ?? null,
            'status'  => $this->status ?? null,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Include City, State, Country
            'city' => new CityResource($this->whenLoaded('city')),
        ];
    }
}
