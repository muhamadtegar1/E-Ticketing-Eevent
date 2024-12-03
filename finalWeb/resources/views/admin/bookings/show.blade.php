@extends('layouts.admin')

@section('title', 'Bookings for Event: ' . $event->name)

@section('content')
    <h1>Bookings for Event: {{ $event->name }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Status</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No bookings found for this event.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $bookings->links() }}
@endsection
