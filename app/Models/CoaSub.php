<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoaSub extends Model
{
    protected $fillable = ['coa_main_id', 'code', 'title', 'type', 'status'];

    public function coaMain()
    {
        return $this->belongsTo(CoaMain::class);
    }

    public function coas()
    {
        return $this->hasMany(Coa::class);
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}
