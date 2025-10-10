<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'img_url'    => $this->img_path ? asset('storage/' . $this->img_path) : null,
            'status'     => $this->status,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Include subcategories only if loaded
            'subcategories' => SubCategoryResource::collection(
                $this->whenLoaded('subcategories')
            ),
        ];
    }
}
