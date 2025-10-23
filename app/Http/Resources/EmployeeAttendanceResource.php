<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        // Eager load required relationships if not loaded
        $this->loadMissing([
            'attendances' => fn($q) => $q->latest(),
            'role',
            'city',
        ]);

        return [
            'id' => $this->id,
            'employee_name' => trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')),
            'email' => $this->email,
            'cnic' => $this->cnic,
            'role' => $this->role->name ?? null,
            'city' => $this->city->title ?? null,
            'status' => $this->status,
            // 'attendances' => CompactAttendanceResource::collection($this->attendances),
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
