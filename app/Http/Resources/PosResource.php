<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosResource extends JsonResource
{
    public function toArray($request)
    {
        // Calculate totals dynamically
        $totalQty = $this->details->sum('qty');
        $totalProductAmount = $this->details->sum(function ($detail) {
            $extrasAmount = $detail->extras->sum('amount');
            return ($detail->qty * $detail->sale_price) - $detail->discAmount + $extrasAmount;
        });

        $grandTotal = $totalProductAmount + $this->tax - $this->discAmount;

        return [
            'id' => $this->id,
            'inv_date' => $this->inv_date,
            'description' => $this->description,
            'tax' => $this->tax,
            'discPer' => $this->discPer,
            'discAmount' => $this->discAmount,
            'inv_amount' => $this->inv_amount,
            'paid' => $this->paid,
            'total_extra_amount' => $this->total_extra_amount,
            'transaction_type_id' => $this->transaction_type_id,
            'payment_mode_id' => $this->payment_mode_id,
            'employee_id' => $this->employee_id,
            'employeeName' => $this->employee->first_name ." " .$this->employee->last_name,

            // Customer Info
            'customer_id' => $this->customer->id,
            'customerName' => $this->customer->name,
            'customerCnic' => $this->customer->cnic,

            // Salesman
            'saleman_id' => $this->employee->id,
            'salemanName' => $this->employee->first_name ." " .$this->employee->last_name,

            // Coa ID of current Selected Customer
            'coa_id' => optional($this->customer->coa)->id, // ✅ safe access


            // ✅ Related Models
            // 'customer' => new CustomerResource($this->whenLoaded('customer')),
            // 'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'details' => PosDetailResource::collection($this->whenLoaded('details')),
            'bank_detail' => new PosBankDetailResource($this->whenLoaded('bankDetail')),
            'payment_mode' => new PaymentModeResource($this->whenLoaded('paymentMode')),
            'transaction_type' => new TransactionTypeResource($this->whenLoaded('transactionType')),

            // ✅ Computed fields
            'computed' => [
                'total_qty' => $totalQty,
                'total_product_amount' => round($totalProductAmount, 2),
                'grand_total' => round($grandTotal, 2),
                'balance_due' => round($grandTotal - $this->paid, 2),
            ],

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
