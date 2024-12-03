<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'image_URL' => 'required|url', // Validasi gambar harus berupa URL valid
        ]);

        // Menambahkan data
        Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'datetime_start' => $validated['datetime_start'],
            'datetime_end' => $validated['datetime_end'],
            'location' => $validated['location'],
            'ticket_price' => $validated['ticket_price'],
            'ticket_quota' => $validated['ticket_quota'],
            'available_ticket' => $validated['ticket_quota'], // Default available_ticket = ticket_quota
            'image_URL' => $validated['image_URL'],
            'organizer_id' => auth()->id(),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'image_URL' => 'required|url', // Validasi gambar harus berupa URL valid
        ]);

        // Update data event
        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
