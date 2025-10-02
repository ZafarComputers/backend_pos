<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'title'                  => $this->title,
            'design_code'            => $this->design_code,
            'image_path'             => $this->image_path,
            'sub_category_id'        => $this->sub_category_id,
            // 'sub_category'           => new SubCategoryResource($this->whenLoaded('subCategory')),
            'sale_price'             => $this->sale_price,
            'opening_stock_quantity' => $this->opening_stock_quantity,
            'vendor_id'              => $this->vendor_id,
            'vendor'                 => new VendorResource($this->whenLoaded('vendor')),
            'barcode'                => $this->barcode,
            'status'                 => $this->status,
            'created_at'             => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'             => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
