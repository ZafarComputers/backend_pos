<?php

namespace Database\Factories;

use App\Models\PosDetail;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosDetailFactory extends Factory
{
    protected $model = PosDetail::class;

    public function definition(): array
    {
        return [
            'pos_id' => Pos::inRandomOrder()->value('id'),
            'product_id' => Product::inRandomOrder()->value('id'),
            'qty' => $this->faker->numberBetween(1, 5),
            'sale_price' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}

