<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        static $used = [];

        do {
            $employeeId = Employee::inRandomOrder()->value('id');
            $date = $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');
            $key = $employeeId . '_' . $date;
        } while (isset($used[$key]));

        $used[$key] = true;

        return [
            'employee_id' => $employeeId,
            'date' => $date,
            'check_in' => $this->faker->time('H:i:s'),
            'check_out' => $this->faker->time('H:i:s'),
            'status' => $this->faker->randomElement(['present', 'absent', 'late', 'half-day']),
            'remarks' => $this->faker->optional()->sentence(),
        ];
    }
}
