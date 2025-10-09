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
            // 'pos_id' => Pos::factory(),
            'pos_id' => Pos::inRandomOrder()->value('id'),
            // 'product_id' => Product::factory(),                      // It generate new products and use them
            'product_id' => Product::inRandomOrder()->value('id'),      // It takes previously saved Prodcuts
            'qty' => $this->faker->numberBetween(1, 10),
            'sale_price' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}