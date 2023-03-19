<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    protected $appends = [
        'role_id',
        'role_name',
        'permission_names',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getRoleIdAttribute()
    {
        return  $this->roles()->first()->id ?? null;
    }


    public function getRoleNameAttribute()
    {
        return  $this->roles()->first()->name ?? 'Unassigned';
    }

    public function getPermissionNamesAttribute()
    {
        $role = $this->roles()->first();
        if($role?->id == 1)
        {
            return Permission::all()->pluck('name')->implode(', ');
        }
        if ($role) {
            return $role->permissions->pluck('name')->implode(', ');
        }
        return '';
    }
}
