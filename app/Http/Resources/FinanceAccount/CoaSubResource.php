<?php

namespace App\Http\Resources\FinanceAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class CoaSubResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'code'      => $this->code,
            'title'     => $this->title,
            'type'      => $this->type,
            'status'    => $this->status,
            'main'      => new CoaMainResource($this->whenLoaded('coaMain')),
            'accounts'  => CoaResource::collection($this->whenLoaded('coas')),
        ];
    }
}
