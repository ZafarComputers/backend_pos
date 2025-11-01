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

            'id' => $this->id,
            // 'date' => $this->date ? $this->date->format('Y-m-d') : null,   // format date
            'amount' => $this->amount ?? 0,
            'description' => $this->description ?? '',
            // 'category_id' => $this->expense_category_id,
            // 'category_name' => optional($this->category)->title,           // fetch category title safely
            // 'status' => $this->status ?? 'Active',
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
