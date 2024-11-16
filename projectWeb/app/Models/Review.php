<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'Event_ID', 'User_ID', 'Rating', 'Comment', 'Date_Posted'
    ];

    // Relationship definitions...
}

