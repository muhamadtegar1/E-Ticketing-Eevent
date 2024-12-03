@extends('layouts.admin')

@section('title', 'Daftar Pemesanan Tiket')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Ticket Booking List</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <!-- Header Tabel -->
            <thead>
                <tr class="bg-blue-600 text-white text-center">
                    <th class="border border-gray-200 px-4 py-2">Event</th>
                    <th class="border border-gray-200 px-4 py-2">User</th>
                    <th class="border border-gray-200 px-4 py-2">Status</th>
                    <th class="border border-gray-200 px-4 py-2">Action</th>
                </tr>
            </thead>

            <!-- Body Tabel -->
            <tbody>
                @foreach ($tickets as $ticket)
                <tr class="hover:bg-gray-50">
                    <!-- Event Name -->
                    <td class="border border-gray-200 px-4 py-2 text-left">{{ $ticket->event->name }}</td>

                    <!-- User Name -->
                    <td class="border border-gray-200 px-4 py-2 text-center">{{ $ticket->user->name }}</td>

                    <!-- Status -->
                    <td class="border border-gray-200 px-4 py-2 text-center">
                        <span class="px-2 py-1 rounded-full text-sm {{ $ticket->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>

                    <!-- Action -->
                    <td class="border border-gray-200 px-3 py-2 text-center">
                        <form action="{{ route('admin.bookings.update', $ticket) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <select name="status" required 
                                    class="border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 px-2">
                                <option value="approved" {{ $ticket->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="canceled" {{ $ticket->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <button type="submit"
                                    class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none h-10">
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
