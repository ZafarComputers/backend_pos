<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'ven_inv_no' => strtoupper($this->faker->bothify('INV###')),
            'ven_inv_date' => $this->faker->date(),
            'ven_inv_ref' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'product_id' => Product::inRandomOrder()->value('id'),
            'discount_percent' => $this->faker->numberBetween(0, 20),
            'discount_amt' => $this->faker->randomFloat(2, 0, 500),
            'inv_amount' => $this->faker->randomFloat(2, 1000, 5000),
        ];
    }
}
