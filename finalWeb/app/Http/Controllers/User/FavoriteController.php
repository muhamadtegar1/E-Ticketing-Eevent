<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Menampilkan daftar favorit
    public function index()
    {
        $favorites = auth()->user()->favorites()->get();
    
        return view('user.favorites.index', compact('favorites'));
    }
    
    // Menambahkan event ke daftar favorit
    public function store(Request $request, Event $event)
    {
        $user = auth()->user();
    
        if (!$event->exists) {
            return redirect()->back()->with('error', 'Event tidak ditemukan.');
        }
    
        if ($user->favorites()->where('event_id', $event->id)->exists()) {
            return redirect()->back()->with('info', 'Event sudah ada di daftar favorit Anda.');
        }
    
        $user->favorites()->attach($event->id);
    
        return redirect()->back()->with('success', 'Event berhasil ditambahkan ke daftar favorit.');
    }
    

    // Menghapus event dari daftar favorit
    public function destroy(Event $event)
    {
        $user = auth()->user();
    
        // Cek apakah event ada di daftar favorit
        $isFavorite = $user->favorites()->where('event_id', $event->id)->exists();
    
        if (!$isFavorite) {
            return redirect()->back()->with('error', 'Acara tidak ditemukan di daftar favorit Anda.');
        }
    
        // Hapus dari favorit menggunakan detach
        $user->favorites()->detach($event->id);
    
        return redirect()->route('user.favorites.index')->with('success', 'Acara berhasil dihapus dari favorit.');
    }
    
}
