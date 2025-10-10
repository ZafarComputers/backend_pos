<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);

        // Convert all null values to empty strings
        array_walk_recursive($data, function (&$value) {
            if (is_null($value)) {
                $value = '';
            }
        });

        return $data;
    }
}
