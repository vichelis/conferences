<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsystem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description', 'color', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function conferences()
    {
        return $this->hasMany(Conference::class);
    }

    public function activeConferences()
    {
        return $this->hasMany(Conference::class)->where('status', 'published');
    }

    public function upcomingConferences()
    {
        return $this->activeConferences()->upcoming();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
