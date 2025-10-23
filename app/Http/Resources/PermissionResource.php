<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        // Return permission fields, including related roles if loaded
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug ?? null, // optional slug field
            'description' => $this->description ?? "N/A",
            'status' => $this->status ?? 'active',

            // ✅ Include related roles if they are eager-loaded
            'roles' => $this->whenLoaded('roles', function () {
                return $this->roles->map(fn($role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'slug' => $role->slug ?? null,
                ]);
            }),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
