@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Event</h1>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Event Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
            <input type="text" name="name" id="name" value="{{ $event->name }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required
                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $event->description }}</textarea>
        </div>

        <!-- Start Date & Time -->
        <div>
            <label for="datetime_start" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
            <input type="datetime-local" name="datetime_start" id="datetime_start" value="{{ $event->datetime_start->format('Y-m-d\TH:i') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- End Date & Time -->
        <div>
            <label for="datetime_end" class="block text-sm font-medium text-gray-700">End Date & Time</label>
            <input type="datetime-local" name="datetime_end" id="datetime_end" value="{{ $event->datetime_end->format('Y-m-d\TH:i') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Location -->
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" value="{{ $event->location }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Ticket Price -->
        <div>
            <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price</label>
            <input type="number" step="0.01" name="ticket_price" id="ticket_price" value="{{ $event->ticket_price }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Ticket Quota -->
        <div>
            <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
            <input type="number" name="ticket_quota" id="ticket_quota" value="{{ $event->ticket_quota }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Event Image URL -->
        <div>
            <label for="image_URL" class="block text-sm font-medium text-gray-700">Event Image URL</label>
            <input type="url" name="image_URL" id="image_URL" value="{{ $event->image_URL }}" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update Event
            </button>
        </div>
    </form>
</div>
@endsection
