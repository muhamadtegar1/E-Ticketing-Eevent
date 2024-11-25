<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\Organizer\TicketController as OrganizerTicketController;


Route::get('/', function () {
    return view('welcome');
});

// Admin Management
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('events', EventController::class)->except(['show']);
    Route::get('reports', [ReportController::class, 'index'])->name('admin.reports');
});



Route::middleware(['auth', 'role:organizer'])->prefix('organizer')->group(function () {
    Route::get('/dashboard', function () {
        return view('organizer.dashboard');
    })->name('organizer.dashboard');

    // Event Management
    Route::resource('events', OrganizerEventController::class);

    // Ticket Management
    Route::get('tickets/manage', [OrganizerTicketController::class, 'index'])->name('organizer.tickets.index');
    Route::patch('tickets/{id}/update', [OrganizerTicketController::class, 'update'])->name('organizer.tickets.update');
});




require __DIR__.'/auth.php';
