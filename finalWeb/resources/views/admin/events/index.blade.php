@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Events</h1>
        <a href="{{ route('admin.events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Create Event
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $event->image_URL }}" alt="{{ $event->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h5 class="text-lg font-bold text-gray-800">{{ $event->name }}</h5>
                <p class="text-gray-600 text-sm mt-2">
                    Location: {{ $event->location }}<br>
                    Date: {{ $event->datetime_start }}<br>
                    Price: ${{ $event->ticket_price }}
                </p>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('admin.events.edit', $event) }}" class="bg-yellow-400 text-gray-800 px-3   py-2 text-sm rounded-lg hover:bg-yellow-500 flex items-center space-x-0">
                        <img src="{{ asset('build\assets\edit_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Edit Icon" class="h-5 w-5">
                        <span></span>
                    </a>
                    
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-400 text-gray-800 px-3 py-2 text-sm rounded-lg hover:bg-red-500 flex items-center space-x-0" onclick="return confirm('Are you sure?')">
                            <img src="{{ asset('build\assets\delete_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Edit Icon" class="h-5 w-5">
                            <span></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $events->links('pagination::tailwind') }}
    </div>
</div>
@endsection
