<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'pur_date' => $this->faker->date(),
            'pur_inv_barcode' => $this->faker->ean13(),
            'vendor_id' => 1, // or Vendor::factory()->create()->id if you have VendorFactory
            'ven_inv_no' => $this->faker->bothify('INV###'),
            'ven_inv_date' => $this->faker->date(),
            'ven_inv_ref' => $this->faker->lexify('REF???'),
            'description' => $this->faker->sentence(),
            'discount_percent' => $this->faker->randomFloat(2, 0, 10),
            'discount_amt' => $this->faker->randomFloat(2, 0, 500),
            'inv_amount' => $this->faker->randomFloat(2, 1000, 5000),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'overdue']), // ✅
        ];
    }
}
