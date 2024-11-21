<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Melihat riwayat pemesanan
    public function index()
    {
        $userId = auth()->id();

        if (!$userId) {
            return redirect()->route('login')->withErrors('Anda harus login untuk melihat riwayat tiket.');
        }

        $tickets = Ticket::where('user_id', $userId)->with('event')->get();
        return view('tickets.history', compact('tickets'));
    }

    // Mengurangi kuota tiket saat tiket dipesan
    public function store(Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return redirect()->route('login')->withErrors('Anda harus login untuk memesan tiket.');
        }

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        Ticket::create([
            'event_id' => $validated['event_id'],
            'user_id' => $userId,
            'status' => 'active',
            'booking_date' => now(),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dipesan.');
    }

    // Melihat daftar pemesanan tiket
    public function manage()
    {
        $tickets = Ticket::with('event', 'user')->get();
        return view('tickets.manage', compact('tickets'));
    }

    // Mengembalikan kuota jika pesanan dibatalkan
    public function destroy($id)
    {
        // Cari tiket berdasarkan ID dan user yang login
        $ticket = Ticket::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    
        // Validasi status tiket
        if ($ticket->status !== 'active') {
            return redirect()->route('tickets.history')->withErrors('Tiket tidak dapat dibatalkan.');
        }
    
        // Update status tiket menjadi 'canceled' dan tambahkan kuota tiket
        $ticket->update(['status' => 'canceled']);
        $ticket->event->increment('available_ticket');
    
        // Redirect dengan pesan sukses
        return redirect()->route('tickets.history')->with('success', 'Tiket berhasil dibatalkan.');
    }
    

    // Menyetujui atau membatalkan pesanan tiket
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,canceled',
        ]);

        $ticket = Ticket::findOrFail($id);

        if ($validated['status'] === 'canceled' && $ticket->status === 'active') {
            $ticket->event->increment('available_ticket');
        }

        $ticket->update(['status' => $validated['status']]);

        return redirect()->route('tickets.manage')->with('success', 'Status tiket berhasil diperbarui.');
    }

    public function history()
    {
        $user = auth()->user();
        $tickets = $user->tickets()->with('event')->paginate(10);
        return view('tickets.history', compact('tickets'));
    }

}