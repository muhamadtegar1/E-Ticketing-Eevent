<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_tickets_sold',
        'total_revenue',
        'average_rating',
        'event_date',
        'event_id',
    ];

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

