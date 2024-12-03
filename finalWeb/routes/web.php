<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Organizer\OrganizerEventController;
use App\Http\Controllers\Organizer\OrganizerTicketController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\FavoriteController;
use App\Http\Controllers\user\BookingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\user\UserEventController;
use App\Http\Controllers\Guest\GuestEventController;
use App\Http\Controllers\ImageUploadController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Guest
Route::get('/', [GuestEventController::class, 'index'])->name('home');
Route::get('/events/{event}', [GuestEventController::class, 'show'])->name('guest.events.detail');
Route::get('/events', [GuestEventController::class, 'index'])->name('guest.events.index');

// Admin Management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('events', EventController::class)->except(['show']);
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{event}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::put('bookings/{id}/update', [AdminBookingController::class, 'update'])->name('bookings.update');
    Route::get('reports', [AdminBookingController::class, 'salesReport'])->name('reports');
    Route::get('activities', [AdminBookingController::class, 'activity'])->name('activities');
});


// Organizer Management
Route::prefix('organizer')->name('organizer.')->middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.organizer');
    })->name('dashboard');
    Route::resource('events', OrganizerEventController::class);
    Route::get('/events/{event}/edit', [OrganizerEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [OrganizerEventController::class, 'update'])->name('events.update');
    Route::get('/tickets/manage', [OrganizerTicketController::class, 'index'])->name('tickets.index');
    Route::put('tickets/{id}/update', [OrganizerTicketController::class, 'update'])->name('tickets.update');
});


// User Management
Route::middleware(['auth', 'role:user'])->name('user.')->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.user');
    })->name('dashboard');
    
    // Event Routes
    Route::get('events', [UserEventController::class, 'index'])->name('events.index');
    Route::get('events/{event}', [UserEventController::class, 'show'])->name('events.detail');

    // Booking Routes
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create/{event}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings/{event}', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('bookings/{ticket}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('favorites/{event}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{event}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});


// Rute untuk Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('upload', [ImageUploadController::class, 'showForm'])->name('upload.form');
Route::post('upload', [ImageUploadController::class, 'uploadImage'])->name('upload.image');



require __DIR__.'/auth.php';
