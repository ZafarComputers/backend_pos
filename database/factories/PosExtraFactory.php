<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PosDetail;

class PosExtraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pos_detail_id' => PosDetail::inRandomOrder()->value('id'),
            'title'         => $this->faker->randomElement(['Lace', 'Size', 'Embroidery', 'Extra Fabric', 'Beads']),
            'value'         => $this->faker->randomElement(['Small', 'Medium', 'Large', 'Golden', 'Custom']),
            'amount'        => $this->faker->randomFloat(2, 100, 1500),
        ];
    }
}
