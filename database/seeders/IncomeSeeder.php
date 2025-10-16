<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;
use App\Models\IncomeCategory;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure some categories exist first
        if (IncomeCategory::count() === 0) {
            IncomeCategory::factory(5)->create();
        }

        // Now create 20 income records
        Income::factory(20)->create();
    }
}
