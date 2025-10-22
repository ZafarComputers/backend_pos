<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CompactAttendanceResource;

class EmployeeAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * Expects the Employee model to have the `attendances` relation loaded
     * (or will lazy-load it).
     */
    public function toArray(Request $request): array
    {
        // Ensure relation is available to avoid N+1 when not loaded
        $this->loadMissing(['attendances' => function ($q) {
            $q->latest();
        }, 'role', 'city']);

        return [
            'employee' => [
                'id' => $this->id,
                'employ_name' => trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')),
                'email' => $this->email ?? null,
                'cnic' => $this->cnic ?? null,
                'role' => optional($this->role)->name ?? null,
                'city' => optional($this->city)->title ?? null,
                'status' => $this->status ?? null,
            ],

            // All attendances for this employee (compact entries)
            'attendances' => CompactAttendanceResource::collection($this->attendances),
        ];
    }
}
