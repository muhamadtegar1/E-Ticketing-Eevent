<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'booking_date',
        'cancel_date',
        'event_id',
        'user_id',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'cancel_date' => 'datetime',
    ];
    

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

