<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Resources
use App\Http\Resources\PosResource;
use App\Http\Resources\PosNoDtlResource;
use App\Http\Resources\PosExtraResource;
use App\Http\Resources\PosWithExtrasResource;

// Models
use App\Models\Coa;
use App\Models\Customer;
use App\Models\Pos;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Employee; // ✅ added
use App\Models\PosReturn;



class PosApiController extends Controller
{
    /**
     * Display all POS invoices.
     */
    public function getAllInvoices()
    {
        try {
            $pos = Pos::with([
                    'customer',
                    'employee',
                    'paymentMode',
                    'transactionType',
                    'bankDetail',
                    'details.product',
                    'details.extras',
                ])
                ->latest()
                ->get();

            if ($pos->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No POS records found for this transaction type.',
                    'data'    => [],
                ], 404);
            }

            return response()->json([
                'status'  => true,
                'message' => 'POS list retrieved successfully.',
                'data'    => PosResource::collection($pos),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to retrieve POS records.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display all POS records.
     */
    public function index()
    {
        // ✅ Include employee relationship
        $pos = Pos::with(['details', 'employee', 'paymentMode'])
            ->where('transaction_type_id', 2)   // Regular Sale ID
            ->latest()
            ->get();
        // dd($pos);
        return PosNoDtlResource::collection($pos);
    }

    /**
     * Store a new POS record with transactions.
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'inv_date'             => 'required|date',
    //         'payment_mode_id'      => 'required|exists:payment_modes,id',
    //         'transaction_type_id'  => 'nullable|exists:transaction_types,id',
    //         'customer_id'          => 'required|exists:customers,id',
    //         'employee_id'          => 'required|exists:employees,id',
    //         'coa_id'               => 'nullable|exists:coas,id',
    //         'coaRef_id'            => 'nullable|exists:coas,id',
    //         'bank_acc_id'          => 'nullable|exists:coas,id',
    //         'tax'                  => 'nullable|numeric|min:0',
    //         'discPer'              => 'nullable|numeric|min:0',
    //         'discAmount'           => 'nullable|numeric|min:0',
    //         'paid'                 => 'nullable|numeric|min:0',
    //         'description'          => 'nullable|string|max:255',

    //         'details'              => 'required|array|min:1',
    //         'details.*.product_id' => 'required|exists:products,id',
    //         'details.*.qty'        => 'required|numeric|min:1',
    //         'details.*.sale_price' => 'required|numeric|min:0',
    //         'details.*.discPer'    => 'nullable|numeric|min:0',
    //         'details.*.discAmount' => 'nullable|numeric|min:0',

    //         'details.*.extras' => 'nullable|array',
    //         'details.*.extras.*.title' => 'nullable|string',
    //         'details.*.extras.*.value' => 'nullable|string',
    //         'details.*.extras.*.amount' => 'nullable|numeric',

    //         'bank_detail' => 'nullable|array',
    //         'bank_detail.bank_name' => 'nullable|string',
    //         'bank_detail.account_title' => 'nullable|string',
    //         'bank_detail.account_number' => 'nullable|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // ✅ Calculate totals
    //         $subtotal = collect($request->details)->sum(fn($d) => $d['qty'] * $d['sale_price']);
    //         $discAmount = $request->discAmount ?? 0;
    //         $tax = $request->tax ?? 0;
    //         $finalAmount = $subtotal - $discAmount + $tax;
    //         $paid = (float) ($request->paid ?? 0);

    //         $payment_status = match (true) {
    //             $paid >= $finalAmount => 'Paid',
    //             $paid <= 0 => 'Unpaid',
    //             default => 'Partial',
    //         };

    //         // ✅ Create POS
    //         $pos = Pos::create([
    //             'inv_date'            => $request->inv_date,
    //             'customer_id'         => $request->customer_id,
    //             // 'customer_id'         => $request->customer->coa->id,
    //             'employee_id'         => $request->employee_id,
    //             'tax'                 => $tax,
    //             'discPer'             => $request->discPer ?? 0,
    //             'discAmount'          => $discAmount,
    //             'inv_amount'          => $finalAmount,
    //             'paid'                => $paid,
    //             'payment_mode_id'     => $request->payment_mode_id,
    //             'transaction_type_id' => $request->transaction_type_id ?? 2,
    //             'payment_status'      => $payment_status,
    //             'description'         => $request->description ?? null,
    //         ]);

    //         // ✅ Store POS Details + Optional Extras
    //         foreach ($request->details as $detail) {
    //             $posDetail = $pos->details()->create([
    //                 'product_id' => $detail['product_id'],
    //                 'qty'        => $detail['qty'],
    //                 'sale_price' => $detail['sale_price'],
    //                 'discPer'    => $detail['discPer'] ?? 0,
    //                 'discAmount' => $detail['discAmount'] ?? 0,
    //                 'total'      => $detail['qty'] * $detail['sale_price'],
    //             ]);

    //             // Optional Extras
    //             if (!empty($detail['extras']) && is_array($detail['extras'])) {
    //                 foreach ($detail['extras'] as $extra) {
    //                     if (!empty($extra['title'])) {
    //                         $posDetail->extras()->create([
    //                             'title'  => $extra['title'],
    //                             'value'  => $extra['value'] ?? null,
    //                             'amount' => $extra['amount'] ?? 0,
    //                         ]);
    //                     }
    //                 }
    //             }

    //             // Update product stock
    //             $product = Product::find($detail['product_id']);
    //             if ($product) {
    //                 $product->increment('stock_out_quantity', $detail['qty']);
    //                 $product->decrement('in_stock_quantity', $detail['qty']);
    //             }
    //         }

    //         // ✅ Optional Bank Detail
    //         if (!empty($request->bank_detail) && !empty($request->bank_detail['bank_name'])) {
    //             $pos->bankDetail()->create([
    //                 'bank_name' => $request->bank_detail['bank_name'],
    //                 'account_title' => $request->bank_detail['account_title'] ?? null,
    //                 'account_number' => $request->bank_detail['account_number'] ?? null,
    //             ]);
    //         }

    //         // ✅ Accounting Transactions
    //         $userId = Auth::id() ?? 1;
    //         $transTypeId = $request->transaction_type_id ?? 2; // Sale
    //         $coaSales = 29; // Revenues -> Sales Revenue -> Product Sales Account
    //         $paymentModeId = (int) $request->payment_mode_id;

    //         // $coaRefId = match ($paymentModeId) {
    //         //     1 => 3, // Cash
    //         //     2 => $request->bank_acc_id,
    //         //     3 => $request->customer_id,
    //         //     // 3 => $request->customer->coas->id,

    //         //     default => throw new \Exception("Invalid payment mode selected."),
    //         // };


    //         // Fetch the customer along with their COAs
    //         $customer = Customer::with('coas')->find($request->customer_id);

    //         if (!$customer) {
    //             throw new \Exception("Customer not found.");
    //         }

    //         // Determine COA reference ID based on payment mode
    //         $paymentModeId = (int) $request->payment_mode_id;

    //         $coaRefId = match ($paymentModeId) {
    //             1 => 3, // Cash account COA ID (replace 3 with your actual Cash COA ID)
                
    //             2 => $request->bank_acc_id 
    //                 ?? throw new \Exception("Bank account ID is required for bank payment."),

    //             3 => $customer->coas->first()?->id 
    //                 ?? throw new \Exception("No COA found for this customer."),

    //             default => throw new \Exception("Invalid payment mode selected."),
    //         };

    //         // Optional: validate $coaRefId
    //         if (empty($coaRefId) || !is_numeric($coaRefId)) {
    //             throw new \Exception("Invalid COA reference detected.");
    //         }


    //         // Credit Sale Account
    //         Transaction::create([
    //             'date' => $request->inv_date,
    //             'invRef_id' => $pos->id,
    //             'transaction_type_id' => $transTypeId,
    //             'coas_id' => $coaSales,
    //             'coaRef_id' => $coaRefId,
    //             'users_id' => $userId,
    //             'description' => 'POS Sale: INV-' . $pos->id,
    //             'debit' => 0,
    //             'credit' => $finalAmount,
    //         ]);

    //         // Debit logic based on payment status
    //         if ($payment_status === 'Paid') {
    //             Transaction::create([
    //                 'date' => $request->inv_date,
    //                 'invRef_id' => $pos->id,
    //                 'transaction_type_id' => $transTypeId,
    //                 'coas_id' => $coaRefId,
    //                 'coaRef_id' => $coaSales,
    //                 'users_id' => $userId,
    //                 'description' => 'POS Sale (Full Payment): INV-' . $pos->id,
    //                 'debit' => $finalAmount,
    //                 'credit' => 0,
    //             ]);
    //         } elseif ($payment_status === 'Partial') {
    //             $balance = $finalAmount - $paid;

    //             Transaction::create([
    //                 'date' => $request->inv_date,
    //                 'invRef_id' => $pos->id,
    //                 'transaction_type_id' => $transTypeId,
    //                 'coas_id' => $coaRefId,
    //                 'coaRef_id' => $coaSales,
    //                 'users_id' => $userId,
    //                 'description' => 'POS Sale (Partial Payment): INV-' . $pos->id,
    //                 'debit' => $paid,
    //                 'credit' => 0,
    //             ]);

    //             Transaction::create([
    //                 'date' => $request->inv_date,
    //                 'invRef_id' => $pos->id,
    //                 'transaction_type_id' => $transTypeId,
    //                 'coas_id' => $request->customer_id,
    //                 'coaRef_id' => $coaSales,
    //                 'users_id' => $userId,
    //                 'description' => 'POS Sale (Balance Due): INV-' . $pos->id,
    //                 'debit' => $balance,
    //                 'credit' => 0,
    //             ]);
    //         } else {
    //             Transaction::create([
    //                 'date' => $request->inv_date,
    //                 'invRef_id' => $pos->id,
    //                 'transaction_type_id' => $transTypeId,
    //                 'coas_id' => $request->customer_id,
    //                 'coaRef_id' => $coaSales,
    //                 'users_id' => $userId,
    //                 'description' => 'POS Sale (On Credit): INV-' . $pos->id,
    //                 'debit' => $finalAmount,
    //                 'credit' => 0,
    //             ]);
    //         }

    //         DB::commit();

    //         $pos->load(['details.product', 'customer', 'employee', 'bankDetail']);
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'POS created successfully.',
    //             'data' => new PosResource($pos),
    //         ], 201);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Failed to create POS.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inv_date'             => 'required|date',
            'payment_mode_id'      => 'required|exists:payment_modes,id',
            'transaction_type_id'  => 'nullable|exists:transaction_types,id',
            'customer_id'          => 'required|exists:customers,id',
            'employee_id'          => 'required|exists:employees,id',
            'bank_acc_id'          => 'nullable|exists:coas,id',
            'tax'                  => 'nullable|numeric|min:0',
            'discPer'              => 'nullable|numeric|min:0',
            'discAmount'           => 'nullable|numeric|min:0',
            'paid'                 => 'nullable|numeric|min:0',
            'description'          => 'nullable|string|max:255',
            'details'              => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|numeric|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            // Fetch customer with COA
            $customer = Customer::with('coa')->find($request->customer_id);
            if (!$customer) throw new \Exception("Customer not found.");

            // Calculate totals
            $subtotal = collect($request->details)->sum(fn($d) => $d['qty'] * $d['sale_price']);
            $discAmount = $request->discAmount ?? 0;
            $tax = $request->tax ?? 0;
            $finalAmount = $subtotal - $discAmount + $tax;
            $paid = (float) ($request->paid ?? 0);

            // Determine payment status
            $payment_status = match (true) {
                $paid >= $finalAmount => 'Paid',
                $paid <= 0 => 'Unpaid',
                default => 'Partial',
            };

            // Create POS
            $pos = Pos::create([
                'inv_date'            => $request->inv_date,
                'customer_id'         => $request->customer_id,
                'employee_id'         => $request->employee_id,
                'tax'                 => $tax,
                'discPer'             => $request->discPer ?? 0,
                'discAmount'          => $discAmount,
                'inv_amount'          => $finalAmount,
                'paid'                => $paid,
                'payment_mode_id'     => $request->payment_mode_id,
                'transaction_type_id' => $request->transaction_type_id ?? 2,
                'payment_status'      => $payment_status,
                'description'         => $request->description ?? null,
            ]);

            // Store POS details
            foreach ($request->details as $detail) {
                $posDetail = $pos->details()->create([
                    'product_id' => $detail['product_id'],
                    'qty'        => $detail['qty'],
                    'sale_price' => $detail['sale_price'],
                    'discPer'    => $detail['discPer'] ?? 0,
                    'discAmount' => $detail['discAmount'] ?? 0,
                    'total'      => $detail['qty'] * $detail['sale_price'],
                ]);
            }

            // Accounting transactions
            $userId = Auth::id() ?? 1;
            $transTypeId = $request->transaction_type_id ?? 2;
            $coaSales = 29; // Sales Revenue COA

            // Determine COA reference based on payment mode
            $coaRefId = match ((int)$request->payment_mode_id) {
                1 => 3, // Cash account COA
                2 => $request->bank_acc_id ?? throw new \Exception("Bank account COA required."),
                3 => $customer->coa?->id ?? throw new \Exception("Customer COA not found."),
                default => throw new \Exception("Invalid payment mode."),
            };

            if (!is_numeric($coaRefId)) throw new \Exception("Invalid COA reference.");

            // Credit Sale Account
            Transaction::create([
                'date' => $request->inv_date,
                'invRef_id' => $pos->id,
                'transaction_type_id' => $transTypeId,
                'coas_id' => $coaSales,
                'coaRef_id' => $coaRefId,
                'users_id' => $userId,
                'description' => 'POS Sale: INV-' . $pos->id,
                'debit' => 0,
                'credit' => $finalAmount,
            ]);

            // Debit logic
            if ($payment_status === 'Paid') {
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_type_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (Full Payment): INV-' . $pos->id,
                    'debit' => $finalAmount,
                    'credit' => 0,
                ]);
            } elseif ($payment_status === 'Partial') {
                $balance = $finalAmount - $paid;
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_type_id' => $transTypeId,
                    'coas_id' => $coaRefId,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (Partial Payment): INV-' . $pos->id,
                    'debit' => $paid,
                    'credit' => 0,
                ]);
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_type_id' => $transTypeId,
                    'coas_id' => $customer->coa->id,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (Balance Due): INV-' . $pos->id,
                    'debit' => $balance,
                    'credit' => 0,
                ]);
            } else { // On Credit
                Transaction::create([
                    'date' => $request->inv_date,
                    'invRef_id' => $pos->id,
                    'transaction_type_id' => $transTypeId,
                    'coas_id' => $customer->coa->id,
                    'coaRef_id' => $coaSales,
                    'users_id' => $userId,
                    'description' => 'POS Sale (On Credit): INV-' . $pos->id,
                    'debit' => $finalAmount,
                    'credit' => 0,
                ]);
            }

            DB::commit();

            $pos->load(['details.product', 'customer', 'employee']);
            return response()->json([
                'status' => true,
                'message' => 'POS created successfully.',
                'data' => new PosResource($pos),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create POS.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Show a single POS.
     */
    public function show($id)
    {
        // ✅ Include employee
        $pos = Pos::with(['customer', 'details.product', 'employee'])->find($id);

        if (!$pos) {
            return response()->json(['status' => false, 'message' => 'POS not found*.'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => new PosResource($pos),
        ]);
    }

    /**
     * Update POS with transactions.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // ✅ Validate request
            $validated = $request->validate([
                'inv_date' => 'required|date',
                'customer_id' => 'required|exists:customers,id',
                'employee_id' => 'required|exists:employees,id',
                'payment_mode_id' => 'required|exists:payment_modes,id',
                'tax' => 'nullable|numeric|min:0',
                'discPer' => 'nullable|numeric|min:0',
                'discAmount' => 'nullable|numeric|min:0',
                'inv_amount' => 'required|numeric|min:0',
                'paid' => 'nullable|numeric|min:0',
                'total_extra_amount' => 'nullable|numeric|min:0',
                'description' => 'nullable|string|max:255',
                'transaction_type_id' => 'nullable|exists:transaction_types,id',

                'details' => 'required|array|min:1',
                'details.*.id' => 'nullable|exists:pos_details,id',
                'details.*.product_id' => 'required|exists:products,id',
                'details.*.qty' => 'required|numeric|min:1',
                'details.*.sale_price' => 'required|numeric|min:0',
                'details.*.discPer' => 'nullable|numeric|min:0',
                'details.*.discAmount' => 'nullable|numeric|min:0',

                'details.*.extras' => 'nullable|array',
                'details.*.extras.*.id' => 'nullable|exists:pos_extras,id',
                'details.*.extras.*.title' => 'required|string',
                'details.*.extras.*.value' => 'nullable|string',
                'details.*.extras.*.amount' => 'nullable|numeric|min:0',

                'bank_detail' => 'nullable|array',
                'bank_detail.bank_name' => 'required_with:bank_detail|string',
                'bank_detail.account_title' => 'nullable|string',
                'bank_detail.account_number' => 'nullable|string',
            ]);

            // ✅ Get POS and verify transaction type
            $pos = Pos::with(['details.extras', 'bankDetail'])
                ->where('id', $id)
                ->first();

            if (!$pos) {
                return response()->json([
                    'status' => false,
                    'message' => 'POS record not found.',
                ], 404);
            }

            // ✅ Update base POS data
            $pos->update([
                'inv_date' => $validated['inv_date'],
                'customer_id' => $validated['customer_id'],
                'employee_id' => $validated['employee_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'transaction_type_id' => $validated['transaction_type_id'] ?? $pos->transaction_type_id,
                'tax' => $validated['tax'] ?? 0,
                'discPer' => $validated['discPer'] ?? 0,
                'discAmount' => $validated['discAmount'] ?? 0,
                'inv_amount' => $validated['inv_amount'],
                'paid' => $validated['paid'] ?? 0,
                'total_extra_amount' => $validated['total_extra_amount'] ?? 0,
                'description' => $validated['description'] ?? null,
            ]);

            // ✅ Update details
            $existingDetailIds = $pos->details->pluck('id')->toArray();
            $submittedDetailIds = collect($validated['details'])->pluck('id')->filter()->toArray();

            // Delete removed details
            $detailsToDelete = array_diff($existingDetailIds, $submittedDetailIds);
            if (!empty($detailsToDelete)) {
                \App\Models\PosDetail::whereIn('id', $detailsToDelete)->delete();
            }

            // Loop details safely
            foreach ($validated['details'] as $detailData) {
                // Find or create detail
                if (isset($detailData['id'])) {
                    $posDetail = \App\Models\PosDetail::find($detailData['id']);
                    if ($posDetail) {
                        $posDetail->update([
                            'product_id' => $detailData['product_id'],
                            'qty' => $detailData['qty'],
                            'sale_price' => $detailData['sale_price'],
                            'discPer' => $detailData['discPer'] ?? 0,
                            'discAmount' => $detailData['discAmount'] ?? 0,
                        ]);
                    }
                } else {
                    // ✅ Proper create with all required fields
                    $posDetail = $pos->details()->create([
                        'product_id' => $detailData['product_id'],
                        'qty' => $detailData['qty'],
                        'sale_price' => $detailData['sale_price'],
                        'discPer' => $detailData['discPer'] ?? 0,
                        'discAmount' => $detailData['discAmount'] ?? 0,
                    ]);
                }

                // ✅ Handle extras (optional)
                if (isset($detailData['extras']) && is_array($detailData['extras'])) {
                    $existingExtraIds = $posDetail->extras->pluck('id')->toArray();
                    $submittedExtraIds = collect($detailData['extras'])->pluck('id')->filter()->toArray();

                    $extrasToDelete = array_diff($existingExtraIds, $submittedExtraIds);
                    if (!empty($extrasToDelete)) {
                        \App\Models\PosExtra::whereIn('id', $extrasToDelete)->delete();
                    }

                    foreach ($detailData['extras'] as $extraData) {
                        if (isset($extraData['id'])) {
                            $posExtra = \App\Models\PosExtra::find($extraData['id']);
                            if ($posExtra) {
                                $posExtra->update([
                                    'title' => $extraData['title'],
                                    'value' => $extraData['value'] ?? null,
                                    'amount' => $extraData['amount'] ?? 0,
                                ]);
                            }
                        } else {
                            $posDetail->extras()->create([
                                'title' => $extraData['title'],
                                'value' => $extraData['value'] ?? null,
                                'amount' => $extraData['amount'] ?? 0,
                            ]);
                        }
                    }
                }
            }

            // ✅ Handle optional bank detail
            if (isset($validated['bank_detail'])) {
                if ($pos->bankDetail) {
                    $pos->bankDetail->update([
                        'bank_name' => $validated['bank_detail']['bank_name'],
                        'account_title' => $validated['bank_detail']['account_title'] ?? null,
                        'account_number' => $validated['bank_detail']['account_number'] ?? null,
                    ]);
                } else {
                    $pos->bankDetail()->create([
                        'bank_name' => $validated['bank_detail']['bank_name'],
                        'account_title' => $validated['bank_detail']['account_title'] ?? null,
                        'account_number' => $validated['bank_detail']['account_number'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS updated successfully.',
                'data' => new \App\Http\Resources\PosResource($pos->fresh([
                    'customer',
                    'employee',
                    'details.product',
                    'details.extras',
                    'bankDetail',
                    'paymentMode',
                    'transactionType',
                ])),
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update POS',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    
    /** * Delete POS and its transactions. */ 
    public function destroy($id)
    {
        try {
            // ✅ Find POS record with all related data
            $pos = Pos::with(['details.extras', 'bankDetail'])
                ->where('id', $id)
                ->where('transaction_type_id', 2)
                ->first();

            if (!$pos) {
                return response()->json([
                    'status' => false,
                    'message' => 'POS not found or not of transaction type 2.',
                ], 404);
            }

            \DB::beginTransaction();

            // ✅ Delete details (and their extras if exist)
            foreach ($pos->details as $detail) {
                if ($detail->extras && $detail->extras->count() > 0) {
                    $detail->extras()->delete(); // Safe delete only if exist
                }
                $detail->delete();
            }

            // ✅ Delete bank detail (if exists)
            if ($pos->bankDetail) {
                $pos->bankDetail()->delete();
            }

            // ✅ Delete main POS record
            $pos->delete();

            \DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS and all related data deleted successfully.',
            ], 200);

        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete POS.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /** * Today's Summary (Sale, Expense, Profit). */ 
    public function todaySummary() 
    { 
        $today = Carbon::now('Asia/Karachi')->toDateString(); 
        $todaysSale = Pos::whereDate('inv_date', $today)->sum('inv_amount'); 
        $todaysExpense = Transaction::whereDate('date', $today) 
            ->whereHas('coa.coaSub.coaMain', fn($q) => $q->where('id', 6)) 
            ->sum('debit'); $todaysEarning = $todaysSale - $todaysExpense; 
            
        return response()->json([ 
            'status' => true, 
            'message' => 'Today summary retrieved successfully.', 
            'data' => [ 'date' => $today, 'Sales' => round($todaysSale, 2), 
                'Expenses' => round($todaysExpense, 2), 
                'Earning' => round($todaysEarning, 2), 
            ], 
        ]); 
    }



    /**
     * Fetch POS records and summary for a specific salesman (employee).
     */
    public function getSalesmanReport($employee_id)
    {
        // dd('You are here... ');
        // Fetch all POS for this salesman with relationships
        // $posRecords = Pos::with([
            //     'customer:id,name',
            //     'details.product:id,title',
            // ])
        $posRecords = Pos::where('employee_id', $employee_id)
        ->orderByDesc('inv_date')
        ->latest()
        ->get();

        // dd($posRecords);

        if ($posRecords->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No sales records found for this salesman.',
            ], 404);
        }

        // ✅ Summary Calculations
        $summary = [
            // 'salesman' => Employee::find($employee_id)->first_name . " " . ->last_name ?? 'Unknown',
            'salesman' => optional(Employee::find($employee_id))->first_name
                ? optional(Employee::find($employee_id))->first_name . ' ' . optional(Employee::find($employee_id))->last_name
                : 'Unknown',
            'total_invoices' => $posRecords->count(),
            'total_sales_amount' => $posRecords->sum('inv_amount'),
            'total_paid' => $posRecords->sum('paid'),
            'total_discount' => $posRecords->sum('discAmount'),
            'total_tax' => $posRecords->sum('tax'),
        ];

        return response()->json([
            'status' => true,
            'message' => 'Salesman report retrieved successfully.',
            'summary' => $summary,
            'data' => PosResource::collection($posRecords),
        ]);
    }

    /**
     * Get all extras for a POS
     * GET /api/pos/{pos}/extras
     */
    // public function bridalOrder(Pos $pos)
    // {
    //     $pos->loadMissing(['extras', 'customer']); // Load needed relations

    //     return new PosWithExtrasResource($pos);
    // }

    // Optional: Include extras in show()
    // public function showExtra(Pos $pos)
    // {
    //     $pos->load(['extras', 'details', 'bankDetail']);
    //     return new PosWithExtrasResource($pos);
    // }



}
