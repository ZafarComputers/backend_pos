<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoaMain extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
    ];

    /**
     * Each main COA can have many sub COAs.
     */
    public function subs()
    {
        return $this->hasMany(CoaSub::class, 'coa_main_id');
    }

    /**
     * Get all COA (child accounts) through CoaSubs.
     */
    public function coas()
    {
        return $this->hasManyThrough(Coa::class, CoaSub::class, 'coa_main_id', 'coa_sub_id');
    }
}
