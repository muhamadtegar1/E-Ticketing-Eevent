<?php
namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('organizer_id', auth()->id())->paginate(10);
        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        return view('organizer.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime_start' => 'required|date|before:datetime_end',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'image_URL' => 'nullable|url',
        ]);

        $validated['organizer_id'] = auth()->id();
        $validated['available_ticket'] = $validated['ticket_quota'];

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime_start' => 'required|date|before:datetime_end',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'image_URL' => 'nullable|url',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
