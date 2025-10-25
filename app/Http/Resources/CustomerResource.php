<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cnic' => $this->cnic,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city->title ?? null,
            'cell_no1' => $this->cell_no1,
            'cell_no2' => $this->cell_no2,
            'cell_no3' => $this->cell_no3,
            'RefCnic' => $this->cnic2,
            'RefName' => $this->name2,
            'image_path' => $this->image_path,
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
