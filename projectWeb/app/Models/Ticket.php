<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'Event_ID', 'User_ID', 'Status', 'Booking_Date', 'cancel_date', 'modified_date'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'Event_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID');
    }
}
