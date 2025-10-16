<?php

namespace App\Http\Resources\Reports\Expenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'expense_name' => $this->name,
            'category' => $this->category?->category,
            'description' => $this->description,
            'date' => $this->date,
            'amount' => $this->amount,
        ];
    }
}
