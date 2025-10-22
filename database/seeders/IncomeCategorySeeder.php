<?php

namespace Database\Seeders;

use App\Models\IncomeCategory;
use Illuminate\Database\Seeder;

class IncomeCategorySeeder extends Seeder
{
    public function run(): void
    {
        IncomeCategory::insert([
            ['income_category' => 'Sales Revenue', 'date' => now()],
            ['income_category' => 'Service Income', 'date' => now()],
            ['income_category' => 'Interest Income', 'date' => now()],
        ]);
    }
}
