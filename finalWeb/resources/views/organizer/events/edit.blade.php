@extends('layouts.organizer')

@section('title', 'Edit Event')

@section('page-title')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Event</h2>
        <form action="{{ route('organizer.events.update', $event) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Event Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                <input type="text" id="name" name="name" value="{{ $event->name }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="5" required
                          class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $event->description }}</textarea>
            </div>

            <!-- Start Date & Time -->
            <div>
                <label for="datetime_start" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                <input type="datetime-local" id="datetime_start" name="datetime_start" value="{{ $event->datetime_start }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- End Date & Time -->
            <div>
                <label for="datetime_end" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                <input type="datetime-local" id="datetime_end" name="datetime_end" value="{{ $event->datetime_end }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="location" name="location" value="{{ $event->location }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Ticket Price -->
            <div>
                <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price</label>
                <input type="number" id="ticket_price" name="ticket_price" value="{{ $event->ticket_price }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Ticket Quota -->
            <div>
                <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
                <input type="number" id="ticket_quota" name="ticket_quota" value="{{ $event->ticket_quota }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_URL" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="url" id="image_URL" name="image_URL" value="{{ $event->image_URL }}"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
