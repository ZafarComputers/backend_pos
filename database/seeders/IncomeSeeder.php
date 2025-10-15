<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;
use App\Models\IncomeCategory;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure some Income Categories exist first
        if (IncomeCategory::count() === 0) {
            IncomeCategory::factory()->count(5)->create();
        }

        // // Now create Incomes using the factory
        // Income::factory()->count(10)->create();
    }
}
