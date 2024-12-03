<?php
namespace App\Http\Controllers\Guest;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Search by name
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', $request->location);
        }

        // Paginate results
        $events = $query->orderBy('datetime_start', 'desc')->paginate(12);

        return view('guest.events.index', compact('events'));
    }

        public function show(Event $event)
    {
        return view('guest.events.detail', compact('event'));
    }
}
