<?php
namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class OrganizerTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('event')
            ->whereHas('event', function ($query) {
                $query->where('organizer_id', auth()->id());
            })
            ->paginate(10);

        return view('organizer.tickets.index', compact('tickets'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,canceled', // Validasi status
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => $validated['status']]);

        return redirect()->route('organizer.tickets.index')->with('success', 'Ticket status updated successfully!');
    }
}
