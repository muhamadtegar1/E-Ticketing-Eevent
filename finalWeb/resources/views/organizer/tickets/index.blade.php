@extends('layouts.organizer')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6  text-center">Ticket Booking List</h1>

    <!-- Tabel Pemesanan -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-center text-sm font-bold">Event</th>
                    <th class="px-4 py-2 text-center text-sm font-bold">User</th>
                    <th class="px-4 py-2 text-center text-sm font-bold">Status</th>
                    <th class="px-4 py-2 text-center text-sm font-bold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($tickets as $ticket)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $ticket->event->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $ticket->user->name }}</td>
                    <td class="px-4 py-2 text-sm  text-center">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $ticket->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'  }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-sm">
                        <form action="{{ route('organizer.tickets.update', $ticket->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <select name="status" required
                                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="approved" {{ $ticket->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="canceled" {{ $ticket->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <button type="submit"
                                    class="bg-blue-600 text-white font-bold py-1 px-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                Update
                            </button>
                        </form>
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
</div>
@endsection
