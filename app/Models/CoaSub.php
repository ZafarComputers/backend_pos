<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoaSub extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'coa_main_id',
        'status',
    ];

    /**
     * Each sub COA belongs to one main COA.
     */
    public function coaMain()
    {
        return $this->belongsTo(CoaMain::class, 'coa_main_id');
    }

    /**
     * Each sub COA can have multiple individual COAs.
     */
    public function coas()
    {
        return $this->hasMany(Coa::class, 'coa_sub_id');
    }
}
