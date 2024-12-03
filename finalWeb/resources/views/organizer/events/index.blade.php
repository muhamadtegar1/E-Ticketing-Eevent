@extends('layouts.organizer')

@section('title', 'Manage Events')

@section('page-title')
@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">My Events</h1>
<div class="container mx-auto px-4">
    <!-- Create New Event Button -->
    <div class="mb-6 flex justify-start">
        <a href="{{ route('organizer.events.create') }}"
           class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Create New Event
        </a>
    </div>

    <!-- Events List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($events as $event)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Event Image -->
                <img src="{{ $event->image_URL }}" alt="{{ $event->name }}" class="w-full h-48 object-cover">

                <!-- Event Content -->
                <div class="p-4">
                    <h5 class="text-lg font-bold text-gray-800">{{ $event->name }}</h5>
                    <p class="text-sm text-gray-600">{{ $event->location }}</p>
                    <p class="text-sm text-gray-600">{{ $event->datetime_start }} - {{ $event->datetime_end }}</p>

                    <!-- Action Buttons -->
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('organizer.events.show', $event->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 text-center">
                            Detail
                        </a>
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $events->links('pagination::tailwind') }}
    </div>
</div>
@endsection
