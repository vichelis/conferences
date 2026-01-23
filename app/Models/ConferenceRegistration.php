<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferenceRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'conference_id',
        'name',
        'email',
        'registered_at',
        'status'
    ];

    protected $casts = [
        'registered_at' => 'datetime'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
