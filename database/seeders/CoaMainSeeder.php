<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoaMain;

class CoaMainSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [

            'Capital & Reserves (Equity)',
            'Current Assets',
            'Fix Assets',
            'Current Liabilities',
            'Revenues',
            'Administrative Expenses'

        ];

        foreach ($titles as $title) {
            CoaMain::create([
                'title' => $title,
                'status' => 'Active'

            ]);
        }
    }
}
