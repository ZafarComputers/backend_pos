<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pos;
use App\Models\PosBankDetail;

class PosBankDetailSeeder extends Seeder
{
    public function run(): void
    {
        $posIds = Pos::inRandomOrder()->take(10)->pluck('id');

        foreach ($posIds as $posId) {
            PosBankDetail::create([
                'pos_id'         => $posId,
                'bank_name'      => fake()->company(),
                'account_number' => fake()->bankAccountNumber(),
            ]);
        }
    }
}
