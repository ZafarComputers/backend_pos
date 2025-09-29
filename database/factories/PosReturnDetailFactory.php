<?php

namespace Database\Factories;

use App\Models\PosReturnDetail;
use App\Models\PosReturn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosReturnDetailFactory extends Factory
{
    protected $model = PosReturnDetail::class;

    public function definition(): array
    {
        return [
            'pos_return_id'     => PosReturn::factory(),
            'product_id'        => Product::factory(),
            'qty'               => $this->faker->numberBetween(1, 10),
            'return_unit_price' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
