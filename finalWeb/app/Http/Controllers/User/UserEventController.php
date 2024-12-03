<?php
namespace App\Http\Controllers\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;

class UserEventController extends Controller
{
    // Menampilkan daftar acara dengan filter dan pagination
    public function index(Request $request)
    {
        $search = $request->input('name');
        $location = $request->input('location');

        $events = Event::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($location, function ($query, $location) {
                $query->where('location', $location);
            })
            ->orderBy('datetime_start', 'desc')
            ->paginate(10);

        return view('user.events.index', compact('events'));
    }

    // Menampilkan detail acara
    public function show(Event $event)
    {
        // Kirimkan satu acara saja
        return view('user.events.detail', compact('event'));
    }
}
