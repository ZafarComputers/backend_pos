<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cnic' => $this->cnic,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->whenLoaded('city', function() {
                return [
                    'id' => $this->city?->id,
                    'name' => $this->city?->title,
                ];
            }),
            'cell_no1' => $this->cell_no1,
            'cell_no2' => $this->cell_no2,
            'status' => $this->status,

            // Single COA (main account)
            'coa' => [
                'id' => $this->coa?->id,
                'coa_sub_id' => $this->coa?->coa_sub_id,
                'code' => $this->coa?->code,
                'title' => $this->coa?->title,
                'type' => $this->coa?->type,
                'status' => $this->coa?->status,
            ],

            // Optional: multiple COAs
            'coas' => $this->whenLoaded('coas', function() {
                return $this->coas->map(function($coa) {
                    return [
                        'id' => $coa->id,
                        'coa_sub_id' => $coa->coa_sub_id,
                        'code' => $coa->code,
                        'title' => $coa->title,
                        'type' => $coa->type,
                        'status' => $coa->status,
                    ];
                });
            }),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }


    /**
     * Transform the resource into an array.
     */
    // public function toArray(Request $request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'cnic' => $this->cnic,
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'address' => $this->address,
    //         'city' => $this->city->title ?? null,
    //         'cell_no1' => $this->cell_no1,
    //         'cell_no2' => $this->cell_no2,
    //         'cell_no3' => $this->cell_no3,
    //         'RefCnic' => $this->cnic2,
    //         'RefName' => $this->name2,
    //         'image_path' => $this->image_path,
    //         'status' => $this->status,
    //         'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
    //         'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,

    //     ];
    // }
}
