<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_id',
        'title',
        'value',
        'amount',
    ];

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
}
