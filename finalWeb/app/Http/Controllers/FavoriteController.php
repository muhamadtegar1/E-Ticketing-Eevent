<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
        public function add($eventId)
    {
        $user = auth()->user();
        $user->favoriteEvents()->attach($eventId);
        return redirect()->back()->with('success', 'Acara ditambahkan ke favorit.');
    }

    public function remove($eventId)
    {
        $user = auth()->user();
        $user->favoriteEvents()->detach($eventId);
        return redirect()->back()->with('success', 'Acara dihapus dari favorit.');
    }

    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();
    
        // Mengambil acara favorit dengan pagination
        $favorites = $user->favoriteEvents()->paginate(10);
    
        // Menampilkan data ke view 'favorites.index'
        return view('favorites.index', compact('favorites'));
    }
    
    public function store(Event $event)
    {
        $user = Auth::user();
        if (!$user->favoriteEvents->contains($event->id)) {
            $user->favoriteEvents()->attach($event->id);
            return redirect()->back()->with('success', 'Acara berhasil ditambahkan ke favorit.');
        }
        return redirect()->back()->with('info', 'Acara sudah ada di daftar favorit Anda.');
    }

    public function destroy(Event $event)
    {
        $user = Auth::user();
        if ($user->favoriteEvents->contains($event->id)) {
            $user->favoriteEvents()->detach($event->id);
            return redirect()->back()->with('success', 'Acara berhasil dihapus dari favorit.');
        }
        return redirect()->back()->with('info', 'Acara tidak ditemukan di daftar favorit Anda.');
    }
}