<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionType;

class TransactionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['transType' => 'Purchase Transaction', 'code' => 'PT'],
            ['transType' => 'Sale Transaction', 'code' => 'ST'],
            ['transType' => 'Purchase Return Transaction', 'code' => 'PRT'],
            ['transType' => 'Sale Return Transaction', 'code' => 'SRT'],
            ['transType' => 'Cash Account', 'code' => 'CT'],
            ['transType' => 'Bank Account', 'code' => 'BT'],
            ['transType' => 'Debtors', 'code' => 'DR'],
            ['transType' => 'Creditors', 'code' => 'CR'],
            ['transType' => 'Expenses', 'code' => 'EXP'],
            ['transType' => 'Income', 'code' => 'INC'],
        ];

        foreach ($types as $type) {
            TransactionType::updateOrCreate(
                ['code' => $type['code']], // match by unique 'code'
                ['transType' => $type['transType']]
            );
        }
    }
}
