<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'DateTime_start', 'DateTime_end', 'location', 'Ticket_Price', 'Ticket_Quota', 'available_ticket', 'Image_URL', 'Creator_ID'
    ];

    // Relationship definitions...
}
