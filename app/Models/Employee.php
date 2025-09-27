<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'cnic',
        'first_name',
        'last_name',
        'email',
        'address',
        'city_id',
        'cell_no1',
        'cell_no2',
        'image_path',
        'status',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
