<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coa;
use App\Models\CoaSub;

class CoaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['coa_sub' => 'Paid-Up Capitals (Share Holders)', 'titles' => ['Mr. Test', 'Mr. Test2']],
            ['coa_sub' => 'Revenues – Reserves', 'titles' => ['Profit & Loss A/C (O/Bal.)']],
            ['coa_sub' => 'Trade Creditors for Services (A/c Payable)', 'titles' => ['TCS Courier Service', 'Naya Tel']],
            ['coa_sub' => 'Accrued Liabilities', 'titles' => ['Petty Cash', 'Salaries Payable', 'Office Rent Payable']],
            ['coa_sub' => 'Bank Accounts', 'titles' => ['ABC Bank A/C #: 00000000000']],
            ['coa_sub' => 'Sales', 'titles' => ['Cash Sale', 'Credit Sales']],
            ['coa_sub' => 'Cost of Sales', 'titles' => ['Purchases (Cash)', 'Purchases (Credit)', 'Salaries & Wages']],
            ['coa_sub' => 'Utility Expense', 'titles' => ['Electricity Bill (00 00000 0000000)']],
            ['coa_sub' => 'Entertainment Expense', 'titles' => ['Kitchen Exp.', 'Refreshment Account']],
        ];

        foreach ($data as $group) {
            $coaSub = CoaSub::firstOrCreate(['title' => $group['coa_sub']]);
            foreach ($group['titles'] as $title) {
                Coa::create([
                    'title' => $title,
                    'coa_sub_id' => $coaSub->id,
                    'status' => 'Active',
                ]);
            }
        }
    }
}
