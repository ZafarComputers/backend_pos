<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $employees = \App\Models\Employee::all();

        foreach ($employees as $employee) {
            // Each employee gets random 5 days of attendance
            foreach (range(1, 5) as $i) {
                \App\Models\Attendance::factory()->create([
                    'employee_id' => $employee->id,
                    'date' => now()->subDays(rand(0, 30))->format('Y-m-d'),
                ]);
            }
        }
    }

}
