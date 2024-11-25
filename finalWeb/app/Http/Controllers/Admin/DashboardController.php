<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $ticketsSold = Ticket::where('status', 'active')->count();
        $totalRevenue = Ticket::join('events', 'tickets.event_id', '=', 'events.id')
            ->where('tickets.status', 'active')
            ->sum('events.ticket_price');

        return view('admin.dashboard', compact('totalUsers', 'totalEvents', 'ticketsSold', 'totalRevenue'));
    }
}
