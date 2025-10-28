<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CoaMain;
use App\Models\CoaSub;
use App\Models\Coa;


class CoaSeeder extends Seeder
{
    public function run(): void
    {

        /**
         * Each CoaMain group is assigned a type and prefix
         * for hierarchical accounting codes.
         */
        $coaData = [
            [
                'title' => 'Capital and Reserves',
                'type'  => 'capital',
                'prefix' => '3',
                'subs'  => [
                    'Paid up Capital / Share Holders' => [
                        'R Anas Kiani',
                    ],
                    'Retained Earnings' => [
                        'Profit and Loss Account',
                    ],
                ],
            ],
            [
                'title' => 'Current Assets',
                'type'  => 'asset',
                'prefix' => '1',
                'subs'  => [
                    'Cash Account' => ['Cash in Hand'],
                    'Bank Account' => ['HBL Bank Account # 00 0000 0000 0000'],
                    'Accounts Receivable' => ['Dummy 1st Customer Account'],
                    'Inventory' => [
                        'Purchase Account',
                        'Sales Account',
                        'Purchase Return Account',
                        'Sales Return Account',
                    ],
                ],
            ],
            [
                'title' => 'Fixed Assets',
                'type'  => 'asset',
                'prefix' => '1',
                'subs'  => [
                    'Office Equipment' => ['Office Equipment Account'],
                    'Furniture and Fixtures' => [
                        'Furniture and Fixtures Account',
                        'Computers and Accessories Account',
                        'Electrical Appliances Account',
                        'Electronic Devices Account',
                    ],
                    'Vehicles' => ['Vehicle Account'],
                    'Building and Land' => [
                        'Building Account',
                        'Land Account',
                    ],
                ],
            ],
            [
                'title' => 'Current Liabilities',
                'type'  => 'liability',
                'prefix' => '2',
                'subs'  => [
                    'Accounts Payable' => ['Dummy Vendor A Account'],
                    'Bank Loans' => ['Bank Loan Account'],
                    'Loans from Directors' => ['Director Loan Account'],
                    'Other Current Liabilities' => ['Tax Payable Account'],
                    'Accrued Expenses' => ['Utilities Payable Account'],
                    'Utility Payable' => [
                        'Electricity Payable Account',
                        'Gas Payable Account',
                        'Water Payable Account',
                        'Internet Payable Account',
                        'Telephone Payable Account',
                    ],
                    'Salary and Wages Payable' => ['Staff Salary Payable Account'],
                ],
            ],
            [
                'title' => 'Revenues',
                'type'  => 'income',
                'prefix' => '4',
                'subs'  => [
                    'Sales Revenue' => [
                        'Product Sales Account',
                        'Service Sales Account',
                    ],
                    'Other Revenues' => [
                        'Interest Income Account',
                        'Rental Income Account',
                    ],
                ],
            ],
            [
                'title' => 'Expenses',
                'type'  => 'expense',
                'prefix' => '5',
                'subs'  => [
                    'Operating Expenses' => [
                        'Rent Expense Account',
                        'Utilities Expense Account',
                        'Office Supplies Expense Account',
                        'Maintenance and Repairs Expense Account',
                    ],
                    'Administrative Expenses' => [
                        'Salaries Expense Account',
                        'Insurance Expense Account',
                        'Depreciation Expense Account',
                    ],
                    'Selling Expenses' => [
                        'Advertising Expense Account',
                        'Sales Commissions Expense Account',
                    ],
                ],
            ],
        ];

        // --- Generate Codes & Insert Data ---
        foreach ($coaData as $mainIndex => $mainGroup) {
            $mainCode = $mainGroup['prefix'] . str_pad(($mainIndex + 1), 3, '0', STR_PAD_LEFT);

            $main = CoaMain::create([
                'code'   => $mainCode,
                'title'  => $mainGroup['title'],
                'type'   => $mainGroup['type'],
                'status' => 'active',
            ]);

            $subCounter = 1;
            foreach ($mainGroup['subs'] as $subTitle => $accounts) {
                $subCode = $mainGroup['prefix']
                    . str_pad(($mainIndex + 1), 2, '0', STR_PAD_LEFT)
                    . str_pad($subCounter, 2, '0', STR_PAD_LEFT);

                $sub = $main->coaSubs()->create([
                    'code'   => $subCode,
                    'title'  => $subTitle,
                    'type'   => $mainGroup['type'],
                    'status' => 'active',
                ]);

                $accCounter = 1;
                foreach ($accounts as $accountTitle) {
                    $accCode = $mainGroup['prefix']
                        . str_pad(($mainIndex + 1), 1, '0', STR_PAD_LEFT)
                        . str_pad($subCounter, 2, '0', STR_PAD_LEFT)
                        . str_pad($accCounter, 2, '0', STR_PAD_LEFT);

                    $sub->coas()->create([
                        'code'   => $accCode,
                        'title'  => $accountTitle,
                        'type'   => $mainGroup['type'],
                        'status' => 'active',
                    ]);

                    $accCounter++;
                }

                $subCounter++;

            }
        }
    }
}
