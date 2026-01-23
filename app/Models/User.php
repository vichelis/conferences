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
        'name',
        'email',
        'password',
        'phone',
        'birth_date',
        'gender',
        'city',
        'bio',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    public function conferenceRegistrations()
    {
        return $this->hasMany(ConferenceRegistration::class, 'email', 'email');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
