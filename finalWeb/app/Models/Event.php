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

    // Relasi One-to-Many ke Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relasi One-to-Many ke Favorite
    public function favoritedByUsers()
    {
        // Relasi many-to-many ke tabel 'favorites' melalui model 'Favorite'
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id')
                    ->using(Favorite::class);
    }

    // Relasi One-to-Many ke Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relasi One-to-One ke EventAnalytics
    public function analytics()
    {
        return $this->hasOne(EventAnalytics::class);
    }

    // Relasi ke Organizer (User)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}

