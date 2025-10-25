<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'transType',
        'code',
    ];

    public function isActive()
    {
        return $this->status === 'Active';
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    
}