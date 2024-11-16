<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'User_ID', 'Event_ID'
    ];

    // Many-to-Many relationship to Event via pivot table is implied here
}
