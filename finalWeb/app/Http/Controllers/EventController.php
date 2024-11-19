<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Menampilkan semua acara (khusus untuk Admin)
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Menyimpan acara baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|integer',
            'image_URL' => 'nullable|url',
        ]);

        $event = new Event($request->all());
        $event->organizer_id = Auth::id();
        $event->save();

        return redirect()->route('my-events.index')->with('success', 'Acara berhasil dibuat.');
    }

    // Memperbarui acara yang ada
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|integer',
            'image_URL' => 'nullable|url',
        ]);

        $event->update($request->all());

        return redirect()->route('my-events.index')->with('success', 'Acara berhasil diperbarui.');
    }

    // Menghapus acara
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('my-events.index')->with('success', 'Acara berhasil dihapus.');
    }
}

