<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
        'status',
    ];

    public function expenses()
    {
        // return $this->hasMany(Expense::class, 'expense_category_id');
        return $this->hasMany(Expense::class, 'expense_category_id', 'id');
    }
}
