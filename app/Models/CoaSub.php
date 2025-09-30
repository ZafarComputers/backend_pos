<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoaSub extends Model
{
    /** @use HasFactory<\Database\Factories\CoaSubFactory> */
    use HasFactory;

    protected $fillable = ['title', 'coa_main_id', 'status'];

    public function coaMain()
    {
        return $this->belongsTo(CoaMain::class);
    }

}
