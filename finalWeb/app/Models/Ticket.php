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

    // Relasi One-to-Many ke TicketStatusHistory
    public function statusHistories()
    {
        return $this->hasMany(TicketStatusHistory::class);
    }
}

