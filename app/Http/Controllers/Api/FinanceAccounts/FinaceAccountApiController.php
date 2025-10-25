<?php

namespace App\Http\Controllers\Api\FinanceAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Resources\FinanceAccount\CashFlowResource;

class FinaceAccountApiController extends Controller
{
    /**
     * Display Cash Flow combining all related tables.
     */
    public function cashFlow(Request $request)
    {
        // Allowed payment modes (e.g. Cash, Bank, Online)
        $allowedPaymentModes = [1, 2, 3];

        // Collect all transaction types in a UNION ALL
        $cashFlowQuery = DB::table('purchases')
            ->leftJoin('banks', 'banks.id', '=', 'purchases.bank_id')
            ->leftJoin('payment_modes', 'payment_modes.id', '=', 'purchases.payment_mode_id')
            ->select(
                'purchases.id',
                'purchases.pur_date as date',
                DB::raw("CONCAT(banks.acc_holder_name, ' (', banks.acc_no, ')') as bank_info"),
                'purchases.description',
                'purchases.inv_amount as debit',
                DB::raw('0 as credit'),
                DB::raw('NULL as balance'),
                'payment_modes.mode_name as payment_mode'
            )
            ->whereIn('purchases.payment_mode_id', $allowedPaymentModes)

            ->unionAll(

                DB::table('purchase_returns')
                    ->leftJoin('banks', 'banks.id', '=', 'purchase_returns.bank_id')
                    ->leftJoin('payment_modes', 'payment_modes.id', '=', 'purchase_returns.payment_mode_id')
                    ->select(
                        'purchase_returns.id',
                        'purchase_returns.return_date as date',
                        DB::raw("CONCAT(banks.acc_holder_name, ' (', banks.acc_no, ')') as bank_info"),
                        'purchase_returns.reason as description',
                        DB::raw('0 as debit'),
                        'purchase_returns.return_amount as credit',
                        DB::raw('NULL as balance'),
                        'payment_modes.mode_name as payment_mode'
                    )
                    ->whereIn('purchase_returns.payment_mode_id', $allowedPaymentModes)
            )

            ->unionAll(

                DB::table('pos')
                    ->leftJoin('banks', 'banks.id', '=', 'pos.bank_id')
                    ->leftJoin('payment_modes', 'payment_modes.id', '=', 'pos.payment_mode_id')
                    ->select(
                        'pos.id',
                        'pos.inv_date as date',
                        DB::raw("CONCAT(banks.acc_holder_name, ' (', banks.acc_no, ')') as bank_info"),
                        'pos.note as description',
                        DB::raw('0 as debit'),
                        'pos.inv_amount as credit',
                        DB::raw('NULL as balance'),
                        'payment_modes.mode_name as payment_mode'
                    )
                    ->whereIn('pos.payment_mode_id', $allowedPaymentModes)
            )

            ->unionAll(

                DB::table('pos_returns')
                    ->leftJoin('banks', 'banks.id', '=', 'pos_returns.bank_id')
                    ->leftJoin('payment_modes', 'payment_modes.id', '=', 'pos_returns.payment_mode_id')
                    ->select(
                        'pos_returns.id',
                        'pos_returns.invRet_date as date',
                        DB::raw("CONCAT(banks.acc_holder_name, ' (', banks.acc_no, ')') as bank_info"),
                        'pos_returns.reason as description',
                        'pos_returns.return_inv_amount as debit',
                        DB::raw('0 as credit'),
                        DB::raw('NULL as balance'),
                        'payment_modes.mode_name as payment_mode'
                    )
                    ->whereIn('pos_returns.payment_mode_id', $allowedPaymentModes)
            )

            ->unionAll(

                DB::table('expenses')
                    ->leftJoin('banks', 'banks.id', '=', 'expenses.bank_id')
                    ->leftJoin('payment_modes', 'payment_modes.id', '=', 'expenses.payment_mode_id')
                    ->select(
                        'expenses.id',
                        'expenses.date',
                        DB::raw("CONCAT(banks.acc_holder_name, ' (', banks.acc_no, ')') as bank_info"),
                        'expenses.name as description',
                        'expenses.amount as debit',
                        DB::raw('0 as credit'),
                        DB::raw('NULL as balance'),
                        'payment_modes.mode_name as payment_mode'
                    )
                    ->whereIn('expenses.payment_mode_id', $allowedPaymentModes)
            )

            ->unionAll(

                DB::table('incomes')
                    ->leftJoin('banks', 'banks.id', '=', 'incomes.bank_id')
                    ->leftJoin('payment_modes', 'payment_modes.id', '=', 'incomes.payment_mode_id')
                    ->select(
                        'incomes.id',
                        'incomes.date',
                        DB::raw("CONCAT(banks.acc_holder_name, ' (', banks.acc_no, ')') as bank_info"),
                        'incomes.notes as description',
                        DB::raw('0 as debit'),
                        'incomes.amount as credit',
                        DB::raw('NULL as balance'),
                        'payment_modes.mode_name as payment_mode'
                    )
                    ->whereIn('incomes.payment_mode_id', $allowedPaymentModes)
            );

        $cashFlow = DB::query()
            ->fromSub($cashFlowQuery, 'cash_flow')
            ->orderByDesc('date')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Cash Flow report generated successfully.',
            'data' => CashFlowResource::collection($cashFlow),
        ]);
    }



}
