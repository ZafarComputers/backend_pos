<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Pos;
use App\Models\PosBankDetail;
use App\Models\PaymentMode;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosFactory extends Factory
{
    protected $model = Pos::class;

    public function definition(): array
    {
        // Randomly pick a PaymentMode record
        $paymentMode = PaymentMode::inRandomOrder()->first();

        // Randomly pick a TransactionType (you can filter if needed)
        $transactionType = TransactionType::inRandomOrder()->first();

        return [
            'inv_date'            => $this->faker->date(),
            'customer_id'         => Customer::inRandomOrder()->value('id') ?? Customer::factory(),
            'tax'                 => $this->faker->randomFloat(2, 0, 100),
            'discPer'             => $this->faker->randomFloat(2, 0, 20),
            'discAmount'          => $this->faker->randomFloat(2, 0, 100),
            'inv_amount'          => $this->faker->randomFloat(2, 10, 1000),
            'paid'                => $this->faker->randomFloat(2, 10, 1000),
            'payment_mode_id'     => $paymentMode?->id ?? 1, // default to Cash if not found
            'transaction_type_id' => $transactionType?->id ?? 1,
        ];
    }

    /**
     * After creating a POS, if payment_mode is 'Bank',
     * automatically create its related PosBankDetail record.
     */
    public function configure()
    {
        return $this->afterCreating(function (Pos $pos) {
            // Fetch the mode name (Cash / Bank / Credit)
            $modeName = $pos->paymentMode?->mode_name;

            if ($modeName === 'Bank') {
                PosBankDetail::create([
                    'pos_id'         => $pos->id,
                    'bank_name'      => fake()->company(),
                    'account_number' => fake()->bankAccountNumber(),
                ]);
            }
        });
    }
}
