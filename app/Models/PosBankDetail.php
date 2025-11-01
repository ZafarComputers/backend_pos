<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosBankDetail extends Model
{
    use HasFactory;

  protected $fillable = [
        'pos_id',
        'bank_name',
        'account_title',
        'account_number',
    ];

    /**
     * Relation to POS
     */
    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_id', 'id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}