<?php

namespace App\Http\Resources\FinanceAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class CoaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'code'     => $this->code,
            'title'    => $this->title,
            'type'     => $this->type,
            'status'   => $this->status,
            'sub'      => new CoaSubResource($this->whenLoaded('coaSub')),
        ];
    }
}
