@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Event</h1>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Event Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
            <input type="text" name="name" id="name" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" required
                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Start Date -->
        <div>
            <label for="datetime_start" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="datetime-local" name="datetime_start" id="datetime_start" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- End Date -->
        <div>
            <label for="datetime_end" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="datetime-local" name="datetime_end" id="datetime_end" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Location -->
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Ticket Price -->
        <div>
            <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price ($)</label>
            <input type="number" name="ticket_price" id="ticket_price" min="0" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Ticket Quota -->
        <div>
            <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
            <input type="number" name="ticket_quota" id="ticket_quota" min="1" required
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Image URL -->
        <div>
            <label for="image_URL" class="block text-sm font-medium text-gray-700">Image URL</label>
            <input type="url" name="image_URL" id="image_URL"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Create Event
            </button>
        </div>
    </form>
</div>
@endsection
