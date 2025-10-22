<?php

namespace App\Http\Resources\Reports\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class InvtInhandResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'productName' => $this->title,
            'barcode' => $this->barcode,
            'design_code' => $this->design_code,
            'image_path' => $this->image_path,
            'category' => $this->subCategory->category ? [
                'id' => $this->subCategory->category->id,
                'CategoryName' => $this->subCategory->category->title,
            ] : null,
            'sub_category' => $this->subCategory ? [
                'id' => $this->subCategory->id,
                'subCatName' => $this->subCategory->title,
            ] : null,

            'balance_stock' => $this->in_stock_quantity,
            'vendor' => $this->vendor ? [
                'id' => $this->vendor->id,
                'vendorName' => $this->vendor->first_name . ' ' . $this->vendor->last_name,
            ] : null,
            'productStatus' => $this->status,
        ];
    }
}
