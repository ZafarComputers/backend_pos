<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoaSubResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'status'  => $this->status,

            // ✅ Include main-code info
            'main_code' => new CoaMainResource($this->whenLoaded('coaMain')),
        ];
    }
}
