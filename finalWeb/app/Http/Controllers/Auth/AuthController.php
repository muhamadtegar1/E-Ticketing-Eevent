<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();

            // Pengalihan berdasarkan peran
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.events.index');
            } elseif ($user->hasRole('organizer')) {
                return redirect()->route('organizer.events.index');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.events.index');
            }
        }

        return redirect()->back()->withErrors('Invalid login credentials.');
    }

    // Menampilkan Form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Tambahkan role 'user' secara default untuk registrasi
        $user->roles()->attach(3); // ID role 'user'

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/events');

    }
}
