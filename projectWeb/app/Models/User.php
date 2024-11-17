<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'Creator_ID');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'User_ID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'User_ID');
    }

    public function favorites()
    {
        return $this->belongsToMany(Event::class, 'favorites', 'User_ID', 'Event_ID');
    }
}
