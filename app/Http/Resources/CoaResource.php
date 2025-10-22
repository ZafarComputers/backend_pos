<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'status'  => $this->status,

            // ✅ Include sub-code info
            'sub_code' => new CoaSubResource($this->whenLoaded('coaSub')),
        ];
    }
}
