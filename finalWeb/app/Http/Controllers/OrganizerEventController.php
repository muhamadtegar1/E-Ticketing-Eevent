<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrganizerEventController extends Controller
{
    public function index()
    {
        $events = Event::where('organizer_id', Auth::id())->paginate(10);
        return view('organizer.events.index', compact('events'));
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Acara berhasil diperbarui.');
    }
}
