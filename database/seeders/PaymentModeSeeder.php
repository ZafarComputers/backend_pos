<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMode;

class PaymentModeSeeder extends Seeder
{
    public function run(): void
    {
        $modes = [
            ['mode_name' => 'Cash', 'description' => 'Payment made using cash.'],
            ['mode_name' => 'Bank', 'description' => 'Payment made through bank transfer or cheque.'],
            ['mode_name' => 'Credit', 'description' => 'Payment made on credit terms.'],
        ];

        foreach ($modes as $mode) {
            PaymentMode::updateOrCreate(['mode_name' => $mode['mode_name']], $mode);
        }
    }
}
