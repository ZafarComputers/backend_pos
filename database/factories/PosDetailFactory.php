<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pos;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PosDetail>
 */
class PosDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pos_id' => Pos::factory(),
            'product_id' => Product::factory(),
            'qty' => $this->faker->numberBetween(1, 10),
            'sale_price' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}