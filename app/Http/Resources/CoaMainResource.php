<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoaMainResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'status'  => $this->status,
        ];
    }
}
