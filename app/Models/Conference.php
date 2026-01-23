<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'start_time', 'end_time',
        'location', 'address', 'price', 'capacity', 'subsystem_id', 'status'
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2'
    ];

    public function subsystem()
    {
        return $this->belongsTo(Subsystem::class);
    }

    public function speakers()
    {
        return $this->hasMany(ConferenceSpeaker::class);
    }

    public function registrations()
    {
        return $this->hasMany(ConferenceRegistration::class);
    }

    public function confirmedRegistrations()
    {
        return $this->hasMany(ConferenceRegistration::class)->where('status', 'confirmed');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', Carbon::today());
    }

    public function scopeBySubsystem($query, $subsystemId)
    {
        return $query->where('subsystem_id', $subsystemId);
    }

    // Accessors
    public function getAvailableSpotsAttribute()
    {
        return $this->capacity - $this->confirmedRegistrations()->count();
    }

    public function getIsFullAttribute()
    {
        return $this->available_spots <= 0;
    }

    public function getFormattedPriceAttribute()
    {
        return '€' . number_format($this->price, 2);
    }

    public function getTimeRangeAttribute()
    {
        return date('H:i', strtotime($this->start_time)) . ' - ' . date('H:i', strtotime($this->end_time));
    }
}
