<?php
namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerEventController extends Controller
    {
    // Menampilkan daftar event milik organizer
    public function index()
    {
        $events = Event::where('organizer_id', Auth::id())->paginate(10);
        return view('organizer.events.index', compact('events'));
    }

    // Menampilkan form untuk membuat event baru
    public function create()
    {
        return view('organizer.events.create');
    }

    // Menyimpan event baru
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
            'organizer_id' => auth()->id(), // Atau sesuai dengan skema Anda
        ]);
            
        return redirect()->route('organizer.events.index')->with('success', 'Event berhasil dibuat!');
    }
    
    // Menampilkan form untuk mengedit event milik organizer
    public function edit($id)
    {
        $event = Event::where('id', $id)
            ->where('organizer_id', auth()->id())
            ->firstOrFail();

        return view('organizer.events.edit', compact('event'));
    }
    
    // Memperbarui event milik organizer
    public function update(Request $request, $id)
    {
        $event = Event::where('id', $id)
            ->where('organizer_id', auth()->id())
            ->firstOrFail();

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

        return redirect()->route('organizer.events.index')->with('success', 'Event berhasil diperbarui.');
    }
    public function show($id)
    {
        // Cari event berdasarkan ID dan pastikan event milik organizer yang sedang login
        $event = Event::where('id', $id)
            ->where('organizer_id', auth()->id()) // Memastikan hanya melihat event yang dibuat oleh organizer
            ->firstOrFail();

        // Mengembalikan tampilan dengan data acara
        return view('organizer.events.show', compact('event'));
    }

        // Menghapus event milik organizer
        public function destroy($id)
        {
            $event = Event::where('id', $id)
                ->where('organizer_id', auth()->id())
                ->firstOrFail();
    
            $event->delete();
    
            return redirect()->route('organizer.events.index')->with('success', 'Event berhasil dihapus.');
        }
}
