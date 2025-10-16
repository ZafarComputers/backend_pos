<?php

namespace Database\Seeders;

// use App\Models\User0;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User0::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PaymentModeSeeder::class,
            CountrySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            // ProfileSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            EmployeeSeeder::class,
            VendorSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            SeasonSeeder::class,
            MaterialSeeder::class,
            ProductSeeder::class,
            PurchaseSeeder::class,
            PurchaseReturnSeeder::class,
            PosSeeder::class,
            PosDetailSeeder::class,
            PosBankDetailSeeder::class,
            PosReturnSeeder::class,
            PosReturnDetailSeeder::class,
            CoaMainSeeder::class,
            CoaSubSeeder::class,
            CoaSeeder::class,
            TransactionTypeSeeder::class,
            ExpenseCategorySeeder::class,
            ExpenseSeeder::class,
            IncomeCategorySeeder::class,
            IncomeSeeder::class,
            BankSeeder::class,
            TransactionSeeder::class,
        ]);



    }
}
