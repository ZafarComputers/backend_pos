<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FinanceAccount\CashFlowResource2;

use App\Models\Transaction;

class TransactionApiController extends Controller
    {
        /**
         * Display a listing of all transactions (Purchase, Sale, Income, Expense).
         */
        public function index2(Request $request)
        {
            $type = $request->get('type'); // 'Purchase', 'Sale', etc.
            $from = $request->get('from');
            $to   = $request->get('to');

            $query = DB::query()
                ->fromSub(function ($query) {
                    $query->from('purchases')->select('pur_date as date', DB::raw("'Purchase' as type"), 'inv_amount as debit', DB::raw('0 as credit'), 'description as note')
                        ->unionAll(DB::table('purchase_returns')->select('return_date as date', DB::raw("'Purchase Return' as type"), DB::raw('0 as debit'), 'return_amount as credit', 'reason as note'))
                        ->unionAll(DB::table('pos')->select('inv_date as date', DB::raw("'Sale' as type"), DB::raw('0 as debit'), 'inv_amount as credit', DB::raw("' - ' as note") ))
                        ->unionAll(DB::table('pos_returns')->select('invRet_date as date', DB::raw("'Sale Return' as type"), 'return_inv_amout as debit', DB::raw('0 as credit'), 'reason as note'))
                        ->unionAll(DB::table('incomes')->select('date', DB::raw("'Income' as type"), DB::raw('0 as debit'), 'amount as credit', 'notes as note'))
                        ->unionAll(DB::table('expenses')->select('date', DB::raw("'Expense' as type"), 'amount as debit', DB::raw('0 as credit'), 'name as note'));
                }, 'all_transactions');

            if ($type) {
                $query->where('type', $type);
            }

            if ($from && $to) {
                $query->whereBetween('date', [$from, $to]);
            }

            $transactions = $query->orderByDesc('date')->paginate(20);

            return response()->json(['status' => true, 'data' => $transactions]);
        }

        
}
