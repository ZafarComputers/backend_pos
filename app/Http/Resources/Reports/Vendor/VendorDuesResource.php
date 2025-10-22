<?php

namespace App\Http\Resources\Reports\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\BaseResource;


class VendorDuesResource extends JsonResource
// class VendorDuesResource extends BaseResource
{
    public function toArray($request)
    {
        // Calculate totals
        $totalPurchases = $this->purchases->sum('inv_amount');
        $totalPaid      = $this->purchases->sum('paid_amount');
        $totalDue       = $totalPurchases - $totalPaid;

        return [
            'vendor_id'      => $this->id,
            'vendor_name'    => $this->first_name ." " .$this->last_name,
            // 'email'          => $this->email ?? '',
            // 'phone'          => $this->phone ?? '',
            'email'          => $this->email,
            'phone'          => $this->phone,
            'total_purchases'=> $totalPurchases,
            'total_paid'     => $totalPaid,
            'total_due'      => $totalDue,
        ];
    }
}
