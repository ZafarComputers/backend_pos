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
            'id' => $this->id,
            'title' => $this->title,

            'img_url' => $this->img_path
                ? asset('storage/' . $this->img_path)
                : null,


            'status' => $this->status,
            'subcategories' => CategoryResource::collection($this->whenLoaded('subcategories')),

        ];
    }
}