<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;

class EmployeeWithAttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Create employees first
        $employees = Employee::factory()->count(10)->create();

        // 2️⃣ For each employee, generate random attendance records
        foreach ($employees as $employee) {
            // Random number of days of attendance (e.g. last 15 days)
            $dates = collect(range(1, 15))
                ->map(fn() => now()->subDays(rand(1, 30))->format('Y-m-d'))
                ->unique(); // make sure dates are unique

            foreach ($dates as $date) {
                Attendance::factory()->create([
                    'employee_id' => $employee->id,
                    'date' => $date,
                ]);
            }
        }
    }
}
