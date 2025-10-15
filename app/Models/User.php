<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cell_no1',
        'cell_no2',
        'img_path',
        'role_id',
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

    // ✅ Role relationship (Many to One)
    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // public function roles()
    // {
        //     return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
        //                 ->withTimestamps();
        // }
        
        
        public function hasRole($role)
        {
            return $this->roles()->where('slug', $role)->exists();
        }
        

    public function hasPermission($permission)
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('slug', $permission);
            })->exists();
    }



}
