<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'Event_ID', 'User_ID', 'Status', 'Booking_Date', 'cancel_date', 'modified_date'
    ];

    // Relationship definitions...
}
