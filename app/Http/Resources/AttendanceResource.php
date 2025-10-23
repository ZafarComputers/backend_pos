<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'check_in' => $this->check_in ?? 'N/A',
            'check_out' => $this->check_out ?? 'N/A',
            'status' => ucfirst($this->status),
            'remarks' => $this->remarks ?? '-',
            'employee' => [
                'id' => $this->employee->id ?? null,
                'name' => $this->employee?->first_name . ' ' . $this->employee?->last_name,
                'email' => $this->employee->email ?? null,
                'role' => $this->employee->role->name ?? null,
                'city' => $this->employee->city->title ?? null,
            ],
        ];
    }
}
