<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 🧾 Define log file path
        $logFile = storage_path('logs/seeder.log');

        // 🧹 Clear old log and start new session
        File::put($logFile, "=== 🚀 Database Seeding Started at " . now() . " ===\n\n");

        // ✅ Seeder execution order (grouped logically)
        $seeders = [

            /*
            |--------------------------------------------------------------------------
            | 1. System Setup
            |--------------------------------------------------------------------------
            */
            PakistanSeeder::class,
            // CountrySeeder::class,
            // StateSeeder::class,
            // CitySeeder::class,

            PaymentModeSeeder::class,
            // RoleSeeder::class,
            // PermissionSeeder::class,
            RolesAndPermissionsSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | 2. Core Users
            |--------------------------------------------------------------------------
            */
            UserSeeder::class,
            // EmployeeWithAttendanceSeeder::class,
            // EmployeeSeeder::class,
            // EmployeeAttendanceSeeder::class,
            // AttendanceSeeder::class,
            // VendorSeeder::class,
            // CustomerSeeder::class,
            // ProfileSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | 3. Product Catalog
            |--------------------------------------------------------------------------
            */
            CategorySeeder::class,
            SubCategorySeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            SeasonSeeder::class,
            MaterialSeeder::class,
            // ProductSeeder::class,


            /*
            |--------------------------------------------------------------------------
            | 4. Accounting / COA
            |--------------------------------------------------------------------------
            */
            CoaSeeder::class,
            TransactionTypeSeeder::class,
            BankSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | 5. POS & Purchase
            |--------------------------------------------------------------------------
            */
            // PurchaseSeeder::class,
            // PurchaseReturnSeeder::class,
            // PosSeeder::class,
            // PosDetailSeeder::class,
            // PosBankDetailSeeder::class,
            // PosReturnSeeder::class,
            // PosReturnDetailSeeder::class,


            /*
            |--------------------------------------------------------------------------
            | 6. Expenses & Incomes
            |--------------------------------------------------------------------------
            */
            // ExpenseCategorySeeder::class,
            // ExpenseSeeder::class,
            // PayOutSeeder::class,
            // PayInSeeder::class,
            // IncomeCategorySeeder::class,
            // IncomeSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | 7. Optional / Miscellaneous
            |--------------------------------------------------------------------------
            */
            // TransactionSeeder::class,
        ];

        // 🧠 Loop through each seeder and execute if file exists
        foreach ($seeders as $seeder) {
            $seederFile = database_path('seeders/' . class_basename($seeder) . '.php');

            if (File::exists($seederFile)) {
                $this->call($seeder);
                $message = "✅ Ran seeder: {$seeder}";
                $this->command->info($message);
            } else {
                $message = "⚠️  Skipped (missing file): {$seeder}";
                $this->command->warn($message);
            }

            // Append every message to seeder log
            File::append($logFile, $message . PHP_EOL);
        }

        // ✅ Write completion line in log
        File::append($logFile, "\n=== ✅ Database Seeding Completed at " . now() . " ===\n");

        // 🟢 Display completion message
        $this->command->info("\n📘 Seeder log saved to: storage/logs/seeder.log\n");
    }
}
