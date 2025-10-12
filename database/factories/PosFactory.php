<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Pos;
use App\Models\PosBankDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosFactory extends Factory
{
    protected $model = Pos::class;

    public function definition(): array
    {
        $paymentModes = ['Cash', 'Credit', 'Bank'];
        $paymentMode = $this->faker->randomElement($paymentModes);

        return [
            'inv_date'     => $this->faker->date(),
            'customer_id'  => Customer::inRandomOrder()->first()->id ?? Customer::factory(),
            'tax'          => $this->faker->randomFloat(2, 0, 100),
            'discPer'      => $this->faker->randomFloat(2, 0, 20),
            'discAmount'   => $this->faker->randomFloat(2, 0, 100),
            'inv_amount'   => $this->faker->randomFloat(2, 10, 1000),
            'paid'         => $this->faker->randomFloat(2, 10, 1000),
            'payment_mode' => $paymentMode,
        ];
    }

    /**
     * After creating a POS, if payment_mode = 'Bank',
     * automatically create its related PosBankDetail.
     */
    public function configure()
    {
        return $this->afterCreating(function (Pos $pos) {
            if ($pos->payment_mode === 'Bank') {
                PosBankDetail::create([
                    'pos_id'         => $pos->id,
                    'bank_name'      => fake()->company(),
                    'account_number' => fake()->bankAccountNumber(),
                ]);
            }
        });
    }
}
