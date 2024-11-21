<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\OrganizerEventController;
use App\Http\Controllers\OrganizerBookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
});

// EVENT MANAGEMENT
// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('events', EventController::class);
});

// Rute untuk Organizer
Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::resource('my-events', EventController::class)->except(['index', 'show']);
});

Route::middleware(['auth', 'role:organizer'])->prefix('organizer')->group(function () {
    Route::resource('events', OrganizerEventController::class);
    Route::get('bookings/{event}', [OrganizerBookingController::class, 'index'])->name('organizer.bookings.index');
});

// TICKET MANAGEMENT
// Routes untuk Registered User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('tickets/book', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/history', [TicketController::class, 'index'])->name('tickets.index');
    Route::delete('tickets/cancel/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});

// Routes untuk Admin/Organizer
Route::middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::get('tickets/manage', [TicketController::class, 'manage'])->name('tickets.manage');
    Route::patch('tickets/status/{id}', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
});

// User Dashboard
Route::middleware(['auth'])->group(function () {
    Route::resource('profile', ProfileController::class)->only(['edit', 'update']);
});

// Ticket History
Route::middleware(['auth'])->group(function () {
    Route::get('tickets/history', [TicketController::class, 'history'])->name('tickets.history');
});

// Acara Favorit
Route::middleware(['auth'])->group(function () {
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('favorites/{event}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{event}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

// Laporan Penjualan 
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});


// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:organizer'])->group(function () {
//     Route::get('/organizer/events', [OrganizerController::class, 'index'])->name('organizer.events');
// });

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
