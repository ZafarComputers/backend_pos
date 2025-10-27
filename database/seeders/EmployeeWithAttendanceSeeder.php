<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\City;

class EmployeeWithAttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get all Pakistan city IDs (or any existing cities)
        $cityIds = City::pluck('id')->toArray();

        if (empty($cityIds)) {
            $this->command->error('No cities found! Run PakistanSeeder first.');
            return;
        }

        // 2. Create 10 employees with valid city_id
        $employees = Employee::factory()
            ->count(10)
            ->state([
                'city_id' => fn() => $cityIds[array_rand($cityIds)],
            ])
            ->create();

        $this->command->info('10 employees created with valid Pakistan cities.');

        // 3. Generate attendance for each employee
        foreach ($employees as $employee) {
            $dates = collect(range(1, 15))
                ->map(fn() => now()->subDays(rand(1, 30))->format('Y-m-d'))
                ->unique()
                ->take(rand(5, 15)); // 5–15 random attendance days

            foreach ($dates as $date) {
                Attendance::factory()->create([
                    'employee_id' => $employee->id,
                    'date'        => $date,
                ]);
            }
        }

        $this->command->info('Attendance records generated.');
    }
}