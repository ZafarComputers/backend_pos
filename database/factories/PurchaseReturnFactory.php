<?php

namespace Database\Factories;

use App\Models\PurchaseReturn;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\TransactionType;
use App\Models\PaymentMode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseReturnFactory extends Factory
{
    protected $model = PurchaseReturn::class;

    public function definition(): array
    {
        return [
            'return_date' => $this->faker->date(),
            'return_inv_no' => 'PR-' . $this->faker->unique()->numerify('####'),
            'vendor_id' => Vendor::inRandomOrder()->value('id') ?? Vendor::factory(),
            'purchase_id' => Purchase::inRandomOrder()->value('id') ?? null,
            'reason' => $this->faker->sentence(),
            'discount_percent' => $this->faker->randomFloat(2, 0, 10),
            'discount_amt' => $this->faker->randomFloat(2, 0, 500),
            'return_amount' => $this->faker->randomFloat(2, 100, 5000),
            'payment_status' => $this->faker->randomElement(['paid', 'partial', 'overdue']),
            'transaction_type_id' => TransactionType::inRandomOrder()->value('id') ?? 1,
            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id') ?? 1,
        ];
    }
}
