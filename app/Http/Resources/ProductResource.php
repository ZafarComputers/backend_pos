<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the product resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'title'                  => $this->title,
            'design_code'            => $this->design_code,
            'image_path'             => $this->image_path ? asset($this->image_path) : null,
            'barcode'                => $this->barcode,
            'qrcode'                 => $this->qrcode??'',
            'sale_price'             => $this->sale_price,
            'opening_stock_quantity' => $this->opening_stock_quantity,
            'stock_in_quantity'      => $this->stock_in_quantity,
            'stock_out_quantity'     => $this->stock_out_quantity,
            'in_stock_quantity'      => $this->in_stock_quantity,
            'status'                 => $this->status,

            // Foreign keys (optional if you return related models)
            'sub_category_id' => $this->sub_category_id,
            'vendor_id'       => $this->vendor_id,
            'user_id'         => $this->user_id,

            
            // Related models (auto-loaded if with() used in controller)
            'category'     => $this->category?->title,
            'sub_category' => $this->subCategory?->title,
            'vendor'       => $this->vendor?->first_name . ' ' . $this->vendor?->last_name,
            
            // 'sub_category' => new SubCategoryResource($this->whenLoaded('subCategory')),
            // 'vendor'       => new VendorResource($this->whenLoaded('vendor')),
            // 'user'         => new UserResource($this->whenLoaded('user')),
            
            // Metadata
            // 'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // 'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
 
            // Pivot relationships (returning only essential fields)
            'colors' => $this->colors->pluck('title')->implode(', '),
            'sizes' => $this->sizes->pluck('title')->implode(', '),
            'seasons' => $this->seasons->pluck('title')->implode(', '),
            'materials' => $this->materials->pluck('title')->implode(', '),
            // 'colors' => ColorResource::collection($this->whenLoaded('colors')),
            // 'sizes'  => SizeResource::collection($this->whenLoaded('sizes')),
            // 'seasons' => SeasonResource::collection($this->whenLoaded('seasons')),
            // 'materials' => MaterialResource::collection($this->whenLoaded('materials')),
 
        ];
    }
}
