<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
        // return $this->belongsToMany(Role::class, 'permission_role')
        //     ->withTimestamps();
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}