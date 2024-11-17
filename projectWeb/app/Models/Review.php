<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'Event_ID', 'User_ID', 'Rating', 'Comment', 'Date_Posted'
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

