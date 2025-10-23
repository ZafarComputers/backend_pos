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
            'full_name'  => $this->first_name . ' ' . $this->last_name,
            'email'      => $this->email,
            'cell_no1'   => $this->cell_no1,
            'cell_no2'   => $this->cell_no2 ?? "N/A",
            'img_path'   => $this->img_path ?? "N/A",
            'status'     => $this->status,
            'role_id'   => $this->role_id,
            // 'role' => [
            //     'id'   => $this->whenLoaded('role', function () {
            //         return $this->role->id;
            //     }),
            //     'name' => $this->whenLoaded('role', function () {
            //         return $this->role->name;
            //     }),
            // ],
            'profile'    => new ProfileResource($this->whenLoaded('profile')),
            'email_verified_at' => $this->email_verified_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}