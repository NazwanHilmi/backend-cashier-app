<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'password',
        'role_id'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'transaksi_id');
    }

    public function isSuperAdmin(): bool {
        return in_array($this->email, config('auth.super_admins'));
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function getRole(){
        return $this->role->name;
    }
}
