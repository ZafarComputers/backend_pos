<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Role;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            // 'cell_no1'   => $this->cell_no1,
            // 'cell_no2'   => $this->cell_no2,

            // 'role'       => new RoleResource($this->whenLoaded('role'))
            // 'role_id' => Role::inRandomOrder()->first()->id,
            'role_id' => $this->role->id,
            'roleTitle' => $this->role->name,
            
            'profile'    => new ProfileResource($this->whenLoaded('profile')),
            'status'     => $this->status,
            // 'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // 'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
