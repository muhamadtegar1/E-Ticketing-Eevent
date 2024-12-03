@extends('layouts.organizer')

@section('title', 'Buat Event Baru')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Event</h2>
        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Event -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                <input type="text" id="name" name="name" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" required rows="5"
                          class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label for="datetime_start" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                <input type="datetime-local" id="datetime_start" name="datetime_start" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label for="datetime_end" class="block text-sm font-medium text-gray-700">Start End & Time</label>
                <input type="datetime-local" id="datetime_end" name="datetime_end" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Lokasi -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="location" name="location" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Harga Tiket -->
            <div>
                <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price</label>
                <input type="number" id="ticket_price" name="ticket_price" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Kuota Tiket -->
            <div>
                <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
                <input type="number" id="ticket_quota" name="ticket_quota" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_URL" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="url" id="image_URL" name="image_URL"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
