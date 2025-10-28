<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\City;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker; // ← ADD THIS

class EmployeeAttendanceSeeder extends Seeder
{
    protected $faker; // ← ADD THIS

    public function __construct(Faker $faker) // ← ADD THIS
    {
        $this->faker = $faker;
    }

    public function run(): void
    {
        // 1. Get valid city & role IDs
        $cityIds = City::pluck('id')->toArray();
        $roleIds = Role::pluck('id')->toArray();

        if (empty($cityIds)) {
            $this->command->error('No cities found! Run PakistanSeeder first.');
            return;
        }
        if (empty($roleIds)) {
            $this->command->warn('No roles found. Creating dummy roles...');
            Role::insert([
                ['name' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Salesman', 'created_at' => now(), 'updated_at' => now()],
            ]);
            $roleIds = Role::pluck('id')->toArray();
        }

        // 2. Create 15 employees
        $employees = Employee::factory()
            ->count(1)
            ->state([
                'city_id' => fn() => $cityIds[array_rand($cityIds)],
                'role_id' => fn() => $roleIds[array_rand($roleIds)],
            ])
            ->create();

        $this->command->info('1 employees created.');

        // 3. Generate attendance (last 30 days, 70% attendance rate)
        foreach ($employees as $employee) {
            $startDate = now()->subDays(3);
            $endDate = now();
            $current = clone $startDate;

            while ($current <= $endDate) {
                // Skip weekends
                if ($current->isWeekend()) {
                    $current->addDay();
                    continue;
                }

                // 70% chance of being present
                if ($this->faker->boolean(70)) {
                    Attendance::factory()->create([
                        'employee_id' => $employee->id,
                        'date' => $current->format('Y-m-d'),
                    ]);
                } else {
                    // Absent or half-day
                    Attendance::factory()->create([
                        'employee_id' => $employee->id,
                        'date' => $current->format('Y-m-d'),
                        'check_in' => null,
                        'check_out' => null,
                        'status' => $this->faker->randomElement(['absent', 'half-day']),
                    ]);
                }

                $current->addDay();
            }
        }

        $this->command->info('Attendance records generated for 30 days.');
    }
}