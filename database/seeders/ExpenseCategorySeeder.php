<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    public function run(): void
    {
        ExpenseCategory::insert([
            ['category' => 'Utilities', 'description' => 'Electricity, water, etc.', 'status' => 'Active'],
            ['category' => 'Salaries', 'description' => 'Employee payments', 'status' => 'Active'],
            ['category' => 'Office Supplies', 'description' => 'Stationery and supplies', 'status' => 'Inactive'],
        ]);
    }
}
