<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Pos, Product, PosExtra};

class PosDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pos_id'      => Pos::inRandomOrder()->value('id'),
            'product_id'  => Product::inRandomOrder()->value('id'),
            'qty'         => $this->faker->numberBetween(1, 10),
            'sale_price'  => $this->faker->randomFloat(2, 5, 50),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($detail) {
            // Create extras for this detail
            PosExtra::factory(rand(1, 2))->create([
                'pos_detail_id' => $detail->id,
            ]);
        });
    }
}
