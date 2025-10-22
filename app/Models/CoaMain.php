<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoaMain extends Model
{
    protected $fillable = ['code', 'title', 'type', 'status'];

    public function coaSubs()
    {
        return $this->hasMany(CoaSub::class);
    }

    /**
     * Get all COA (child accounts) through CoaSubs.
    */
    public function coas()
    {
        return $this->hasManyThrough(Coa::class, CoaSub::class, 'coa_main_id', 'coa_sub_id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }
    
    
}