<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class OrganizerBookingController extends Controller
{
    public function index(Event $event)
    {
        $this->authorize('view', $event);

        $bookings = Ticket::where('event_id', $event->id)->with('user')->paginate(10);

        return view('organizer.bookings.index', compact('event', 'bookings'));
    }
}
