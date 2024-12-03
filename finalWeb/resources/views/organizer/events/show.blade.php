@extends('layouts.organizer')

@section('title', 'Event Details')

@section('page-title')

@section('content')
<div class="container mx-auto px-4">
    
<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Event Details</h2>
    <!-- Event Card -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Event Image -->
        <img src="{{ $event->image_URL }}" alt="{{ $event->name }}" class="w-full h-64 object-cover">

        <!-- Event Details -->
        <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">{{ $event->name }}</h3>
            <p class="text-gray-600 mb-2"><strong>Description:</strong> {{ $event->description }}</p>
            <p class="text-gray-600 mb-2"><strong>Start:</strong> {{ $event->datetime_start }}</p>
            <p class="text-gray-600 mb-2"><strong>End:</strong> {{ $event->datetime_end }}</p>
            <p class="text-gray-600 mb-2"><strong>Location:</strong> {{ $event->location }}</p>
            <p class="text-gray-600 mb-2"><strong>Ticket Price:</strong> ${{ $event->ticket_price }}</p>
            <p class="text-gray-600 mb-2"><strong>Ticket Quota:</strong> {{ $event->ticket_quota }}</p>
            <p class="text-gray-600"><strong>Available Tickets:</strong> {{ $event->available_ticket }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="bg-gray-100 p-4 flex justify-between items-center">
            <a href="{{ route('organizer.events.edit', $event) }}"
               class="bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                Edit
            </a>
            <form action="{{ route('organizer.events.destroy', $event) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
                        onclick="return confirm('Are you sure you want to delete this event?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
