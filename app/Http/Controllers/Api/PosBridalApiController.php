<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// Resources
use App\Http\Resources\PosResource;
use App\Http\Resources\PosBankDetailResource;
use App\Http\Resources\PaymentModeResource;



// Models
use App\Models\Pos;
use App\Models\Product;

class PosBridalApiController extends Controller
{

    public function index()
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
                ->where('transaction_type_id', 11)
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
     * Store a newly created POS.
     */
    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'inv_date' => 'required|date',
                'customer_id' => 'required|exists:customers,id',
                'employee_id' => 'required|exists:employees,id',
                'payment_mode_id' => 'required|exists:payment_modes,id',
                'tax' => 'nullable|numeric',
                'discPer' => 'nullable|numeric',
                'discAmount' => 'nullable|numeric',
                'inv_amount' => 'required|numeric',
                'paid' => 'required|numeric',
                'total_extra_amount' => 'nullable|numeric',
                'description' => 'nullable|string|max:255',

                // Nested data
                'details' => 'required|array|min:1',
                'details.*.product_id' => 'required|exists:products,id',
                'details.*.qty' => 'required|integer|min:1',
                'details.*.sale_price' => 'required|numeric',
                'details.*.discPer' => 'nullable|numeric',
                'details.*.discAmount' => 'nullable|numeric',

                // Extras (optional)
                'details.*.extras' => 'array',
                'details.*.extras.*.title' => 'required|string',
                'details.*.extras.*.value' => 'nullable|string',
                'details.*.extras.*.amount' => 'nullable|numeric',

                // Bank detail (optional)
                'bank_detail' => 'array',
                'bank_detail.bank_name' => 'required_with:bank_detail|string',
                'bank_detail.account_title' => 'nullable|string',
                'bank_detail.account_number' => 'nullable|string',
            ]);

            // ✅ Create main POS record
            $pos = Pos::create([
                'inv_date' => $validated['inv_date'],
                'customer_id' => $validated['customer_id'],
                'employee_id' => $validated['employee_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'transaction_type_id' => 11, // ✅ fixed
                'tax' => $validated['tax'] ?? 0,
                'discPer' => $validated['discPer'] ?? 0,
                'discAmount' => $validated['discAmount'] ?? 0,
                'inv_amount' => $validated['inv_amount'],
                'paid' => $validated['paid'],
                'total_extra_amount' => $validated['total_extra_amount'] ?? 0,
                'description' => $validated['description'] ?? null,
            ]);

            // ✅ Create POS Details
            foreach ($validated['details'] as $detailData) {
                $posDetail = $pos->details()->create([
                    'product_id' => $detailData['product_id'],
                    'qty' => $detailData['qty'],
                    'sale_price' => $detailData['sale_price'],
                    'discPer' => $detailData['discPer'] ?? 0,
                    'discAmount' => $detailData['discAmount'] ?? 0,
                ]);

                // ✅ Create POS Extras (if any)
                if (!empty($detailData['extras'])) {
                    foreach ($detailData['extras'] as $extra) {
                        $posDetail->extras()->create([
                            'title' => $extra['title'],
                            'value' => $extra['value'] ?? null,
                            'amount' => $extra['amount'] ?? 0,
                        ]);
                    }
                }
            }

            // ✅ Create Bank Details if payment mode = Bank
            if (
                isset($validated['bank_detail']) &&
                $pos->paymentMode?->mode_name === 'Bank'
            ) {
                $pos->bankDetail()->create([
                    'bank_name' => $validated['bank_detail']['bank_name'],
                    'account_title' => $validated['bank_detail']['account_title'] ?? null,
                    'account_number' => $validated['bank_detail']['account_number'] ?? null,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'POS created successfully.',
                'data' => new PosResource($pos->load([
                    'customer',
                    'employee',
                    'details.product',
                    'details.extras',
                    'bankDetail',
                    'paymentMode',
                    'transactionType',
                ])),
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create POS.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display a specific POS.
     */
    public function show($id)
    {
        try {
            $pos = Pos::with([
                    'customer',
                    'employee',
                    'details.product',
                    'details.extras',
                    'bankDetail',
                    'paymentMode',
                    'transactionType'
                ])
                ->where('id', $id)
                ->where('transaction_type_id', 11) // ✅ verify transaction type
                ->first();

            if (!$pos) {
                return response()->json([
                    'status' => false,
                    'message' => 'POS record not found for the given ID and transaction type.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'POS details retrieved successfully.',
                'data' => new PosResource($pos),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve POS details.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Update an existing POS.
     */
    public function update(Request $request, $id)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'inv_date' => 'required|date',
                'customer_id' => 'required|exists:customers,id',
                'employee_id' => 'required|exists:employees,id',
                'payment_mode_id' => 'required|exists:payment_modes,id',
                'tax' => 'nullable|numeric',
                'discPer' => 'nullable|numeric',
                'discAmount' => 'nullable|numeric',
                'inv_amount' => 'required|numeric',
                'paid' => 'required|numeric',
                'total_extra_amount' => 'nullable|numeric',
                'description' => 'nullable|string|max:255',

                'details' => 'required|array|min:1',
                'details.*.id' => 'nullable|exists:pos_details,id',
                'details.*.product_id' => 'required|exists:products,id',
                'details.*.qty' => 'required|integer|min:1',
                'details.*.sale_price' => 'required|numeric',
                'details.*.discPer' => 'nullable|numeric',
                'details.*.discAmount' => 'nullable|numeric',

                'details.*.extras' => 'array',
                'details.*.extras.*.id' => 'nullable|exists:pos_extras,id',
                'details.*.extras.*.title' => 'required|string',
                'details.*.extras.*.value' => 'nullable|string',
                'details.*.extras.*.amount' => 'nullable|numeric',

                'bank_detail' => 'array',
                'bank_detail.bank_name' => 'required_with:bank_detail|string',
                'bank_detail.account_title' => 'nullable|string',
                'bank_detail.account_number' => 'nullable|string',
            ]);

            // ✅ Find POS (must belong to transaction_type_id = 11)
            $pos = Pos::with(['details.extras', 'bankDetail'])
                ->where('id', $id)
                ->where('transaction_type_id', 11)
                ->first();

            if (!$pos) {
                return response()->json([
                    'status' => false,
                    'message' => 'POS not found or not of transaction type 11.',
                ], 404);
            }

            \DB::beginTransaction();

            // ✅ Update POS main record
            $pos->update([
                'inv_date' => $validated['inv_date'],
                'customer_id' => $validated['customer_id'],
                'employee_id' => $validated['employee_id'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'tax' => $validated['tax'] ?? 0,
                'discPer' => $validated['discPer'] ?? 0,
                'discAmount' => $validated['discAmount'] ?? 0,
                'inv_amount' => $validated['inv_amount'],
                'paid' => $validated['paid'],
                'total_extra_amount' => $validated['total_extra_amount'] ?? 0,
                'description' => $validated['description'] ?? null,
            ]);

            // ✅ Handle details
            $existingDetailIds = $pos->details->pluck('id')->toArray();
            $submittedDetailIds = collect($validated['details'])->pluck('id')->filter()->toArray();

            // Delete removed details
            $detailsToDelete = array_diff($existingDetailIds, $submittedDetailIds);
            if ($detailsToDelete) {
                \App\Models\PosDetail::whereIn('id', $detailsToDelete)->delete();
            }

            foreach ($validated['details'] as $detailData) {
                if (empty($detailData['product_id'])) {
                    continue; // Skip invalid entries
                }

                // Update or create detail
                $posDetail = isset($detailData['id'])
                    ? \App\Models\PosDetail::find($detailData['id'])
                    : $pos->details()->create([
                        'product_id' => $detailData['product_id'],
                        'qty' => $detailData['qty'],
                        'sale_price' => $detailData['sale_price'],
                        'discPer' => $detailData['discPer'] ?? 0,
                        'discAmount' => $detailData['discAmount'] ?? 0,
                    ]);

                if ($posDetail) {
                    $posDetail->update([
                        'product_id' => $detailData['product_id'],
                        'qty' => $detailData['qty'],
                        'sale_price' => $detailData['sale_price'],
                        'discPer' => $detailData['discPer'] ?? 0,
                        'discAmount' => $detailData['discAmount'] ?? 0,
                    ]);
                }

                // ✅ Handle extras
                if (isset($detailData['extras']) && is_array($detailData['extras'])) {
                    $existingExtraIds = $posDetail->extras->pluck('id')->toArray();
                    $submittedExtraIds = collect($detailData['extras'])->pluck('id')->filter()->toArray();
                    $extrasToDelete = array_diff($existingExtraIds, $submittedExtraIds);

                    if ($extrasToDelete) {
                        \App\Models\PosExtra::whereIn('id', $extrasToDelete)->delete();
                    }

                    foreach ($detailData['extras'] as $extraData) {
                        if (!empty($extraData['title'])) {
                            $posDetail->extras()->updateOrCreate(
                                ['id' => $extraData['id'] ?? null],
                                [
                                    'title' => $extraData['title'],
                                    'value' => $extraData['value'] ?? null,
                                    'amount' => $extraData['amount'] ?? 0,
                                ]
                            );
                        }
                    }
                }
            }

            // ✅ Handle bank details
            if (isset($validated['bank_detail'])) {
                $bank = $validated['bank_detail'];
                if ($pos->bankDetail) {
                    $pos->bankDetail->update([
                        'bank_name' => $bank['bank_name'],
                        'account_title' => $bank['account_title'] ?? null,
                        'account_number' => $bank['account_number'] ?? null,
                    ]);
                } else {
                    $pos->bankDetail()->create([
                        'bank_name' => $bank['bank_name'],
                        'account_title' => $bank['account_title'] ?? null,
                        'account_number' => $bank['account_number'] ?? null,
                    ]);
                }
            }

            \DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS updated successfully.',
                'data' => new PosResource(
                    $pos->fresh([
                        'customer',
                        'employee',
                        'details.product',
                        'details.extras',
                        'bankDetail',
                        'paymentMode',
                        'transactionType',
                    ])
                ),
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update POS.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Remove the specified POS.
     */
   public function destroy($id)
    {
        try {
            // ✅ Find POS only if it belongs to transaction_type_id = 11
            $pos = Pos::with(['details.extras', 'bankDetail'])
                ->where('id', $id)
                ->where('transaction_type_id', 11)
                ->first();

            if (!$pos) {
                return response()->json([
                    'status' => false,
                    'message' => 'POS not found or not of transaction type 11.',
                ], 404);
            }

            \DB::beginTransaction();

            // ✅ Delete extras for each detail
            foreach ($pos->details as $detail) {
                $detail->extras()->delete();
            }

            // ✅ Delete details
            $pos->details()->delete();

            // ✅ Delete bank detail (if exists)
            $pos->bankDetail()?->delete();

            // ✅ Delete POS itself
            $pos->delete();

            \DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS and all related records deleted successfully.',
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

}
