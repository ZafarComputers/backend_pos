<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('08:00', '10:00');
        $checkOut = (clone $checkIn)->modify('+7-9 hours');

        $status = 'present';
        if ($checkIn->format('H') >= 9) {
            $status = 'late';
        }

        return [
            'date' => $this->faker->date(),
            'check_in' => $checkIn->format('H:i:s'),
            'check_out' => $checkOut->format('H:i:s'),
            'status' => $status,
            'remarks' => $this->faker->optional(0.2)->sentence,
        ];
    }
}