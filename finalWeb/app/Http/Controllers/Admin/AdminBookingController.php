<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserActivity;

class AdminBookingController extends Controller
{
    // Menampilkan daftar semua pemesanan
    public function index()
    {
        $tickets = Ticket::with('event', 'user')->paginate(10);

        return view('admin.bookings.index', compact('tickets'));
    }

    // Menyetujui atau membatalkan tiket
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,canceled', // Validasi status
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => $validated['status']]);

        return redirect()->route('admin.bookings.index')->with('success', 'Ticket status updated successfully!');
    }
    

    // Melihat laporan penjualan tiket
    public function salesReport()
    {
        $reports = Ticket::selectRaw('event_id, COUNT(*) as total_tickets, SUM(events.ticket_price) as total_revenue')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->groupBy('event_id')
            ->with('event')
            ->get();

        return view('admin.reports.index', compact('reports'));
    }

    public function activity()
    {
        $activities = UserActivity::with('user')->latest()->paginate(10);

        return view('admin.activities.index', compact('activities'));
    }
}
