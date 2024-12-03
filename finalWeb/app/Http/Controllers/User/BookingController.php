<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{    
    // Store Booking
    public function store(Event $event)
    {
        // Check if tickets are available
        if ($event->available_ticket < 1) {
            return redirect()->back()->withErrors('Tickets are sold out.');
        }

        // Check if the user has already booked a ticket for this event
        // if (Ticket::where('event_id', $event->id)->where('user_id', Auth::id())->exists()) {
        //     return redirect()->back()->withErrors('You have already booked a ticket for this event.');
        // }

        // Create ticket booking
        Ticket::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'status' => 'active',
            'booking_date' => now(),
        ]);

        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => "Booked a ticket for event : {$event->name}",
        ]);

        // Decrease available tickets
        $event->decrement('available_ticket');

        return redirect()->route('user.bookings.index')->with('success', 'Ticket booked successfully.');
    }

    // Index Booking
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->with('event')->paginate(10);
    
        return view('user.bookings.index', compact('tickets'));
    }
    

    // Cancel Booking
    public function destroy(Ticket $ticket)
    {
        // Authorization: Ensure the user owns the ticket
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Unauthorized action.');
        }

        // Update ticket status to canceled
        $ticket->update(['status' => 'canceled']);

        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => "Canceled a booking for event : {$ticket->event->name}",
        ]);

        // Increment the event's available tickets
        $ticket->event->increment('available_ticket');

        return redirect()->route('user.bookings.index')->with('success', 'Booking canceled successfully.');
    }
}
