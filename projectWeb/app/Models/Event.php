<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'DateTime_start', 'DateTime_end', 'location', 'Ticket_Price', 'Ticket_Quota', 'available_ticket', 'Image_URL', 'Creator_ID'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'Creator_ID');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'Event_ID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'Event_ID');
    }

    public function analytics()
    {
        return $this->hasOne(EventAnalytics::class, 'event_id');
    }
}
