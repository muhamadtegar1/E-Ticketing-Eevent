<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'changed_at',
        'ticket_id',
    ];

    // Relasi ke Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

