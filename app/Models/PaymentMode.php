<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;

    protected $fillable = ['mode_name', 'description', 'status'];

    // Relationships
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function purchaseReturns()
    {
        return $this->hasMany(PurchaseReturn::class);
    }

    public function pos()
    {
        return $this->hasMany(Pos::class);
    }

    public function posReturns()
    {
        return $this->hasMany(PosReturn::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
