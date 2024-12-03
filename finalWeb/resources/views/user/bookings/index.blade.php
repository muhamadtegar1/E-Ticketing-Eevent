@extends('layouts.user')

@section('title', 'My Bookings')

@section('content')
<div class="container mx-auto p-4">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Bookings History</h1>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg p-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Booking Table -->
    @if ($tickets->isEmpty())
        <p class="text-center text-gray-600">You have no bookings yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <!-- Tabel Header -->
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Event</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Date</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Action</th>
                    </tr>
                </thead>
                <!-- Tabel Body -->
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 text-left text-gray-800">
                                {{ $ticket->event->name }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-left text-gray-600 text-center">
                                {{ \Carbon\Carbon::parse($ticket->booking_date)->format('d M Y H:i') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <span class="{{ $ticket->status == 'active' ? 'text-green-600 font-semibold' : 'text-gray-600' }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @if ($ticket->status == 'active')
                                    <form action="{{ route('user.bookings.destroy', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="px-3 py-1 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                        >
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $tickets->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
