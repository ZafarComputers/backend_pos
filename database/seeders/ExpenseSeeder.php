<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $category = ExpenseCategory::first() ?? ExpenseCategory::factory()->create();

        // Expense::factory(10)->create([
        //     'expense_category_id' => $category->id,
        // ]);
    }
}
