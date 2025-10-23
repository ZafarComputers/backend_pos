<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        // Make sure permissions are eager-loaded in controller (role->load('permissions'))
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug ?? null, // if you have slug field
            'description' => $this->description ?? "N/A", // optional
            'status' => $this->status ?? 'active',

            // ✅ Include permissions if relation is loaded
            'permissions' => $this->whenLoaded('permissions', function () {
                return $this->permissions->map(fn($perm) => [
                    'id' => $perm->id,
                    'name' => $perm->name,
                    'slug' => $perm->slug ?? null,
                ]);
            }),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
