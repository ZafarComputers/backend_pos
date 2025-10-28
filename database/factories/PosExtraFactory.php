<?php

namespace Database\Factories;

use App\Models\Pos;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosExtraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pos_id' => Pos::factory(),
            'title'  => $this->faker->randomElement(['Lace', 'Size', 'Embroidery', 'Extra Fabric', 'Beads']),
            'value'  => $this->faker->randomElement(['Small', 'Medium', 'Large', 'Golden', 'Custom']),
            'amount' => $this->faker->randomFloat(2, 100, 1500),
        ];
    }
}
