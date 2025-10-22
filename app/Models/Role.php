<?php

// app/Models/Role.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id')
                    ->withTimestamps();
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')
                    ->withTimestamps();
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function hasPermission($permissionSlug)
    {
        return $this->permissions()->where('slug', $permissionSlug)->exists();
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }


}
