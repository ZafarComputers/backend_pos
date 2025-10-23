<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompactAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'employee' => [
                'id' => $this->id,
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'cnic' => $this->cnic,
                'role' => $this->role->title ?? null,
                'city' => $this->city->title ?? null,
                'status' => $this->status ? 'Active' : 'Inactive',
            ],
            'attendances' => $this->attendances->map(fn($attendance) => [
                'id' => $attendance->id,
                'date' => $attendance->date,
                'check_in' => $attendance->check_in ?? 'N/A',
                'check_out' => $attendance->check_out ?? 'N/A',
                'status' => ucfirst($attendance->status),
                'remarks' => $attendance->remarks ?? '-',
            ]),
        ];
    }
}
