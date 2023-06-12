<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'id',
        'email',
        'password',
        'full_name',
        'avatar',
        'name',
        'phone',
        'address',
        'introduce',
        'size',
        'url',
        'is_active',
    ];

    protected function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
