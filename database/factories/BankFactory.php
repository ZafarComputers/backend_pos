<?php

namespace Database\Factories;

use App\Models\TransactionType;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    protected $model = Bank::class;

    public function definition(): array
    {
        // Dynamically ensure the correct TransactionType exists for 'Bank Account'
        $bankTypeId = TransactionType::where('code', 'BT')->value('id')
                        ?? TransactionType::factory()->create([
                            'transType' => 'Bank Account',
                            'code' => 'BT',
                        ])->id;

        return [
            'transaction_type_id' => $bankTypeId,
            'acc_holder_name' => $this->faker->name(),
            'acc_no' => $this->faker->unique()->bankAccountNumber(),
            'acc_type' => $this->faker->randomElement(['Current', 'Saving']),
            'op_balance' => $this->faker->randomFloat(2, 1000, 100000),
            'note' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Active', 'Closed']),
        ];
    }
}
