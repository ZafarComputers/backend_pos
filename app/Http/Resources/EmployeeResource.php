<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->fullname,
            'email' => $this->email,
            'position' => $this->role->name  ?? 'N/A',
            'cnic #: ' => $this->cnic,
            'address' => $this->address,
            'city' => $this->city->title,
            'cell_no1' => $this->cell_no1,
            'cell_no2' => $this->cell_no2 ? $this->cell_no2 : 'N/A',
            'status' => $this->isActive() ? 'Active' : 'Inactive',
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
