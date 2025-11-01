<?php

namespace App\Http\Resources\Reports\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class InvtInhandResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            // 🟢 Vendor (null-safe)
            'vendor' => $this->vendor
            ? trim($this->vendor->first_name . ' ' . $this->vendor->last_name)
            : null,
            
            // 🟢 Category (through SubCategory, null-safe)
            'category' => optional($this->subCategory?->category)->title,
            
            // 🟢 Subcategory
            'sub_category' => $this->subCategory->title ?? null,
            
            // 'design_code' => $this->design_code,
            'sale_price' => $this->sale_price,
            // 'opening_stock_quantity' => $this->opening_stock_quantity,
            // 'stock_in_quantity' => $this->stock_in_quantity,
            // 'stock_out_quantity' => $this->stock_out_quantity,
            'in_stock_quantity' => $this->in_stock_quantity,

            // 🟢 Status (Active/Inactive)
            'status' => $this->status,

            'lastUpdate' => $this->created_at
                ? $this->created_at->format('M d, Y')
                : null,

        ];
    }
}
