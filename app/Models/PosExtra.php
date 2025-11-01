<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_detail_id',
        'title',
        'value',
        'amount',
    ];

    public function posDetail()
    {
        return $this->belongsTo(PosDetail::class);
    }

}
