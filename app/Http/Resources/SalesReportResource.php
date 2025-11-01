<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'invoice_no'      => $this->id,
            'invoice_date'    => $this->inv_date,
            'ProductName'   => $this->details
            
            
            
            // these are final (but use another resource file - don't delete from here)
            // 'invoice_no'      => $this->id,
            // 'invoice_date'    => $this->inv_date,
            // 'customer_name'   => optional($this->customer)->name,
            // 'salesman'        => optional($this->employee)->first_name . ' ' . optional($this->employee)->last_name,
            // 'total_amount'    => $this->inv_amount,
            // 'discount'        => $this->discAmount,
            // 'paid_amount'     => $this->paid,
            // 'balance_amount'  => $this->inv_amount - $this->paid,
            // 'details'         => PosInvoiceDetailResource::collection($this->details),
        ];
    }
}
