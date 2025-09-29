<?php

namespace Database\Factories;

use App\Models\PosReturn;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosReturnFactory extends Factory
{
    protected $model = PosReturn::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->value('id'),
            'invRet_date' => $this->faker->date(),
            'pos_inv_no' => 'POS-' . $this->faker->unique()->numberBetween(1000, 9999),
            'return_inv_amout' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}

