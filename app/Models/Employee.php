<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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
        'role_id',
        'status',
    ];


    // Employee has many attendances
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Example relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function isActive()
    {
        return $this->status === 'Active';
    }

    public function posRecords()
    {
        return $this->hasMany(Pos::class);
    }

    public function coas()
    {
        return $this->hasMany(Coa::class, 'employee_id');
    }



}