<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        // Create multiple banks using the factory
        Bank::factory(1)->create();
    }
}
