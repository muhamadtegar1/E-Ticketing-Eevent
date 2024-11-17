<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites'; // Menentukan nama tabel secara eksplisit jika perlu

    protected $fillable = [
        'User_ID', 'Event_ID'
    ];

    // Definisikan hubungan dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID');
    }

    // Definisikan hubungan dengan Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'Event_ID');
    }
}
