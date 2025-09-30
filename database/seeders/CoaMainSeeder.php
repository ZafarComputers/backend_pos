<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoaMain;

class CoaMainSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Capital & Reserves',
            'Long Term Loans',
            'Deferred Liabilities',
            'Current Liabilities',
            'Fix Assets',
            'Long Term Assets',
            'Current Assets',
            'Revenues',
            'Admin Expenses'
        ];

        foreach ($titles as $title) {
            CoaMain::create([
                'title' => $title,
                'status' => 'active'
            ]);
        }
    }
}
