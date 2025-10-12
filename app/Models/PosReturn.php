<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'vendor_id',
        'invRet_date',
        'pos_id',
        'return_inv_amout',
    ];

    // ✅ Relations

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_id');
    }

    public function details()
    {
        return $this->hasMany(PosReturnDetail::class, 'pos_return_id');
    }
    
}
