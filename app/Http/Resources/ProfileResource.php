<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'user_id'         => $this->user_id,
            'user'            => new UserResource($this->whenLoaded('user')), // loads user details only if loaded
            'phone'           => $this->phone,
            'address'         => $this->address, 
            'gender'          => $this->gender,
            'dob' => $this->dob ? \Carbon\Carbon::parse($this->dob)->format('Y-m-d') : null,
            // 'dob'             => $this->dob ? $this->dob->format('Y-m-d') : null, // format date nicely
            'profile_picture' => $this->profile_picture ? url($this->profile_picture) : null, // absolute URL if exists
            'created_at'      => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at'      => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
