<?php

namespace App\Http\Resources\FinanceAccount;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FinanceAccount\CoaSubResource;

class CoaMainResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'code'    => $this->code,
            'title'   => $this->title,
            'type'    => $this->type,
            'status'  => $this->status,
            'subs'    => CoaSubResource::collection($this->whenLoaded('coaSubs')),
        ];
    }
}
