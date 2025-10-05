<?php

namespace Database\Factories;

use App\Models\PurchaseReturn;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseReturnFactory extends Factory
{
    protected $model = PurchaseReturn::class;

    public function definition(): array
    {
        return [
            'return_date' => $this->faker->date(),
            'return_inv_no' => 'PR-' . $this->faker->unique()->numberBetween(1000, 9999),
            'vendor_id' => Vendor::factory(), // create vendor if not exists
            'reason' => $this->faker->sentence(),
            'discount_percent' => $this->faker->randomFloat(2, 0, 10),
            'discount_amt' => $this->faker->randomFloat(2, 0, 500),
            'return_amount' => $this->faker->randomFloat(2, 100, 2000),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'overdue']),

        ];
    }
}
