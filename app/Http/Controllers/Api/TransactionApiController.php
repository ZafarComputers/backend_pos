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


        /**
         * Display a listing of all transactions (Purchase, Sale, Income, Expense).
         */
        // public function cashFlow2(Request $request)
        // {
        //     $type = $request->get('type'); // 'Purchase', 'Sale', etc.
        //     $from = $request->get('from');
        //     $to   = $request->get('to');

        //     $query = DB::query()
        //         ->fromSub(function ($query) {
        //             $query->from('purchases')->select('pur_date as date', DB::raw("'Purchase' as TransactionType"), 'inv_amount as debit', DB::raw('0 as credit'), 'description')
        //                 ->unionAll(DB::table('purchase_returns')->select('return_date as date', DB::raw("'Purchase Return' as TransactionType"), DB::raw('0 as debit'), 'return_amount as credit', 'reason as description'))
        //                 ->unionAll(DB::table('pos')->select('inv_date as date', DB::raw("'Sale' as TransactionType"), DB::raw('0 as debit'), 'inv_amount as credit', DB::raw("' - ' as description") ))
        //                 ->unionAll(DB::table('pos_returns')->select('invRet_date as date', DB::raw("'Sale Return' as TransactionType"), 'return_inv_amout as debit', DB::raw('0 as credit'), 'reason as description'))
        //                 ->unionAll(DB::table('incomes')->select('date', DB::raw("'Income' as TransactionType"), DB::raw('0 as debit'), 'amount as credit', 'notes as ndescriptionote'))
        //                 ->unionAll(DB::table('expenses')->select('date', DB::raw("'Expense' as TransactionType"), 'amount as debit', DB::raw('0 as credit'), 'name as description'));
        //         }, 'all_transactions');

        //     if ($type) {
        //         $query->where('type', $type);
        //     }

        //     if ($from && $to) {
        //         $query->whereBetween('date', [$from, $to]);
        //     }

        //     $transactions = $query->orderByDesc('date')->paginate(20);

        //     return response()->json(['status' => true, 'data' => $transactions]);
        // }

        public function cashFlow2(Request $request)
        {
            $type = $request->get('type');
            $from = $request->get('from');
            $to   = $request->get('to');

            $query = DB::query()->fromSub(function ($query) {

                $query->from('purchases')
                    ->join('payment_modes', 'payment_modes.id', '=', 'purchases.payment_mode_id')
                    ->leftJoin('banks', 'banks.id', '=', 'purchases.bank_id')
                    ->whereIn('payment_modes.id', [1, 2]) // ✅ Only Cash & Bank
                    ->select(
                        'purchases.pur_date as date',
                        DB::raw("'Purchase' as transaction_type"),
                        'purchases.inv_amount as debit',
                        DB::raw('0 as credit'),
                        'purchases.description',
                        DB::raw("
                            CASE
                                WHEN payment_modes.mode_name = 'Bank' THEN CONCAT('Bank: ', banks.acc_holder_name, ' (', banks.acc_no, ')')
                                WHEN payment_modes.mode_name = 'Cash' THEN 'Cash Payment'
                                ELSE NULL
                            END as payment_source
                        ")
                    )

                    ->unionAll(
                        DB::table('purchase_returns')
                            ->join('payment_modes', 'payment_modes.id', '=', 'purchase_returns.payment_mode_id')
                            ->leftJoin('banks', 'banks.id', '=', 'purchase_returns.bank_id')
                            ->whereIn('payment_modes.id', [1, 2])
                            ->select(
                                'purchase_returns.return_date as date',
                                DB::raw("'Purchase Return' as transaction_type"),
                                DB::raw('0 as debit'),
                                'purchase_returns.return_amount as credit',
                                'purchase_returns.reason as description',
                                DB::raw("
                                    CASE
                                        WHEN payment_modes.mode_name = 'Bank' THEN CONCAT('Bank: ', banks.acc_holder_name, ' (', banks.acc_no, ')')
                                        WHEN payment_modes.mode_name = 'Cash' THEN 'Cash Received'
                                        ELSE NULL
                                    END as payment_source
                                ")
                            )
                    )

                    ->unionAll(
                        DB::table('pos')
                            ->join('payment_modes', 'payment_modes.id', '=', 'pos.payment_mode_id')
                            ->leftJoin('banks', 'banks.id', '=', 'pos.bank_id')
                            ->whereIn('payment_modes.id', [1, 2])
                            ->select(
                                'pos.inv_date as date',
                                DB::raw("'Sale' as transaction_type"),
                                DB::raw('0 as debit'),
                                'pos.inv_amount as credit',
                                'pos.note as description',
                                DB::raw("
                                    CASE
                                        WHEN payment_modes.mode_name = 'Bank' THEN CONCAT('Bank Deposit: ', banks.acc_holder_name, ' (', banks.acc_no, ')')
                                        WHEN payment_modes.mode_name = 'Cash' THEN 'Cash Sale'
                                        ELSE NULL
                                    END as payment_source
                                ")
                            )
                    )

                    ->unionAll(
                        DB::table('pos_returns')
                            ->join('payment_modes', 'payment_modes.id', '=', 'pos_returns.payment_mode_id')
                            ->leftJoin('banks', 'banks.id', '=', 'pos_returns.bank_id')
                            ->whereIn('payment_modes.id', [1, 2])
                            ->select(
                                'pos_returns.invRet_date as date',
                                DB::raw("'Sale Return' as transaction_type"),
                                'pos_returns.return_inv_amount as debit',
                                DB::raw('0 as credit'),
                                'pos_returns.reason as description',
                                DB::raw("
                                    CASE
                                        WHEN payment_modes.mode_name = 'Bank' THEN CONCAT('Refund from Bank: ', banks.acc_holder_name, ' (', banks.acc_no, ')')
                                        WHEN payment_modes.mode_name = 'Cash' THEN 'Cash Refund'
                                        ELSE NULL
                                    END as payment_source
                                ")
                            )
                    )

                    ->unionAll(
                        DB::table('incomes')
                            ->join('payment_modes', 'payment_modes.id', '=', 'incomes.payment_mode_id')
                            ->leftJoin('banks', 'banks.id', '=', 'incomes.bank_id')
                            ->whereIn('payment_modes.id', [1, 2])
                            ->select(
                                'incomes.date',
                                DB::raw("'Income' as transaction_type"),
                                DB::raw('0 as debit'),
                                'incomes.amount as credit',
                                'incomes.notes as description',
                                DB::raw("
                                    CASE
                                        WHEN payment_modes.mode_name = 'Bank' THEN CONCAT('Received in Bank: ', banks.acc_holder_name, ' (', banks.acc_no, ')')
                                        WHEN payment_modes.mode_name = 'Cash' THEN 'Cash Income'
                                        ELSE NULL
                                    END as payment_source
                                ")
                            )
                    )

                    ->unionAll(
                        DB::table('expenses')
                            ->join('payment_modes', 'payment_modes.id', '=', 'expenses.payment_mode_id')
                            ->leftJoin('banks', 'banks.id', '=', 'expenses.bank_id')
                            ->whereIn('payment_modes.id', [1, 2])
                            ->select(
                                'expenses.date',
                                DB::raw("'Expense' as transaction_type"),
                                'expenses.amount as debit',
                                DB::raw('0 as credit'),
                                'expenses.name as description',
                                DB::raw("
                                    CASE
                                        WHEN payment_modes.mode_name = 'Bank' THEN CONCAT('Paid via Bank: ', banks.acc_holder_name, ' (', banks.acc_no, ')')
                                        WHEN payment_modes.mode_name = 'Cash' THEN 'Cash Expense'
                                        ELSE NULL
                                    END as payment_source
                                ")
                            )
                    );

            }, 'all_transactions');

            if ($type) {
                $query->where('transaction_type', $type);
            }
            if ($from && $to) {
                $query->whereBetween('date', [$from, $to]);
            }

            $transactions = $query->orderBy('date')->get();

            // 🔹 Calculate running balance
            $balance = 0;
            $transactions->transform(function ($item) use (&$balance) {
                $balance += $item->credit - $item->debit;
                $item->balance = $balance;
                return $item;
            });

            // 🔹 Manual Pagination
            $page = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 20;
            $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
                $transactions->forPage($page, $perPage),
                $transactions->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return CashFlowResource2::collection($paginated)
                ->additional(['status' => true, 'message' => 'Cash/Bank cash flow generated successfully']);
        }


        public function index()
        {
            return response()->json([
                'status' => true,
                'data' => Transaction::all()
            ]);
        }

        public function store(Request $request)
        {
            dd($request->all());
            $validated = $request->validate([
                'ref_no' => 'required|unique:transactions',
                'date' => 'required|date',
                'category' => 'required|string',
                'description' => 'nullable|string',
                'debit' => 'required|numeric',
                'credit' => 'required|numeric',
                'trans_type' => 'required|string',
                'balance' => 'required|numeric',
                // 'transaction_type_id' => 1,
            ]);

            $transaction = Transaction::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Transaction created successfully.',
                'data' => $transaction
            ]);
        }

        public function show(Transaction $transaction)
        {
            return response()->json(['status' => true, 'data' => $transaction]);
        }

        public function update(Request $request, Transaction $transaction)
        {
            $validated = $request->validate([
                'ref_no' => 'required|unique:transactions,ref_no,' . $transaction->id,
                'date' => 'required|date',
                'category' => 'required|string',
                'description' => 'nullable|string',
                'debit' => 'required|numeric',
                'credit' => 'required|numeric',
                'trans_type' => 'required|string',
                'balance' => 'required|numeric',
                // 'transaction_type_id' => 1,
            ]);

            $transaction->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Transaction updated successfully.',
                'data' => $transaction
            ]);
        }

        public function destroy(Transaction $transaction)
        {
            $transaction->delete();
            return response()->json(['status' => true, 'message' => 'Transaction deleted successfully.']);
        }

        
}
