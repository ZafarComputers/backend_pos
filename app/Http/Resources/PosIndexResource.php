<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            // POS Information (shown once per invoice)
            'InvId'         => $this->id,
            'InvDate'       => $this->inv_date,
            'Customer'      => $this->customer?->name ?? 'N/A',
            'Employee'      => $this->employee?->name ?? 'N/A',
            'Description'   => $this->description,
            'InvAmount'     => (float) $this->inv_amount,
            'Paid'          => (float) $this->paid,
            'Tax'           => (float) $this->tax,
            'DiscountPer'   => (float) $this->discPer,
            'DiscountAmt'   => (float) $this->discAmount,
            'PaymentMode'   => $this->paymentMode?->mode_name ?? 'N/A',
            'TransType'     => $this->transactionType?->type_name ?? 'N/A',

            // All Extras (repeated for each row)
            'extras' => PosExtraResource::collection(
                $this->whenLoaded('extras')
            ),
        ];
    }
}