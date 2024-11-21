<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class EventPolicy
{
    /**
     * Tentukan apakah pengguna dapat melihat daftar model.
     */
    public function viewAny(User $user): bool
    {
        // izinkan jika pengguna memiliki peran 'admin'
        return $user->hasRole('admin');
    }

    /**
     * Tentukan apakah pengguna dapat melihat model tertentu.
     */
    public function view(User $user, Event $event): bool
    {
        // izinkan jika pengguna adalah penyelenggara acara atau memiliki peran 'admin'
        return $user->id === $event->organizer_id || $user->hasRole('admin');
    }

    /**
     * Tentukan apakah pengguna dapat membuat model.
     */
    public function create(User $user): bool
    {
        // izinkan jika pengguna memiliki peran 'organizer' atau 'admin'
        return $user->hasRole('organizer') || $user->hasRole('admin');
    }

    /**
     * Tentukan apakah pengguna dapat memperbarui model.
     */
    public function update(User $user, Event $event): bool
    {
        // Izinkan jika pengguna adalah penyelenggara acara atau memiliki peran 'admin'
        return $user->id === $event->organizer_id || $user->hasRole('admin');
    }

    /**
     * Tentukan apakah pengguna dapat menghapus model.
     */
    public function delete(User $user, Event $event): bool
    {
        // Izinkan jika pengguna adalah penyelenggara acara atau memiliki peran 'admin'
        return $user->id === $event->organizer_id || $user->hasRole('admin');
    }

    /**
     * Tentukan apakah pengguna dapat memulihkan model.
     */
    public function restore(User $user, Event $event): bool
    {
        // izinkan jika pengguna memiliki peran 'admin'
        return $user->hasRole('admin');
    }

    /**
     * Tentukan apakah pengguna dapat menghapus permanen model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        // izinkan jika pengguna memiliki peran 'admin'
        return $user->hasRole('admin');
    }
}

