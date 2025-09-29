<?php

namespace Database\Factories;

use App\Models\Pos;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosFactory extends Factory
{
    protected $model = Pos::class;

    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 500, 5000);
        $discPer = $this->faker->randomElement([0, 5, 10]);
        $discount = ($amount * $discPer) / 100;
        $tax = $this->faker->randomElement([0, 50, 100]);

        return [
            'customer_id' => Customer::inRandomOrder()->value('id'),
            'inv_date' => $this->faker->date(),
            'inv_amout' => $amount,
            'tax' => $tax,
            'discPer' => $discPer,
            'discount' => $discount,
        ];
    }
}
