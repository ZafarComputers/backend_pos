<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cell_no1',
        'cell_no2',
        'img_path',
        'email_verified_at',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     // ✅ Profile relationship (One to One)
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_user');
}

public function hasRole($role)
{
    if (is_array($role)) {
        return $this->roles()->whereIn('name', $role)->exists();
    }
    return $this->roles()->where('name', $role)->exists();
}

public function hasPermission($permission)
{
    return $this->roles()
        ->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })
        ->exists();
}



}
