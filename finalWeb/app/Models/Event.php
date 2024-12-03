<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'datetime_start',
        'datetime_end',
        'location',
        'ticket_price',
        'ticket_quota',
        'available_ticket',
        'image_URL',
        'organizer_id',
    ];

    protected $casts = [
        'datetime_start' => 'datetime',
        'datetime_end' => 'datetime',
    ];

    // Relasi many-to-many ke tabel 'users' melalui tabel pivot 'favorites'
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id')
                    ->using(Favorite::class)
                    ->withTimestamps();
    }
    
    // Relasi One-to-Many ke Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relasi ke Organizer (User)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}

