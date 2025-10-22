<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_category',
        'date',
    ];

    public function incomes()
    {
        return $this->hasMany(Income::class, 'income_category_id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}
