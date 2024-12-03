@extends('layouts.user')

@section('title', 'Homepage - Daftar Acara')

@section('content')
<div class="container mx-auto p-4">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">List of Latest Events</h1>

    <!-- Search and Filter -->
    <form action="{{ route('user.events.index') }}" method="GET" class="flex flex-wrap gap-4 justify-center mb-6">
        <input 
            type="text" 
            name="name" 
            placeholder="Cari nama acara" 
            value="{{ request('name') }}" 
            class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        >
        <select 
            name="location" 
            class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        >
            <option value="">Select Location</option>
            <option value="Indoor" {{ request('location') == 'Indoor' ? 'selected' : '' }}>Indoor</option>
            <option value="Outdoor" {{ request('location') == 'Outdoor' ? 'selected' : '' }}>Outdoor</option>
        </select>
        <button 
            type="submit" 
            class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500"
        >
            Search
        </button>
    </form>

    <!-- Event Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($events as $event)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img 
                    src="{{ $event->image_URL }}" 
                    alt="{{ $event->name }}" 
                    class="w-full h-48 object-cover"
                >
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800">{{ $event->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $event->location }} | {{ optional($event->datetime_start)->format('d M Y H:i') }}</p>
                    <p class="text-sm text-gray-800 font-semibold">{{ number_format($event->ticket_price, 0, ',', '.') }} IDR</p>
                    <a 
                        href="{{ route('user.events.detail', $event->id) }}" 
                        class="inline-block mt-4 px-3 py-1 text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                    >
                        Detail
                    </a>
                    @if ($event->available_ticket == 0)
                        <span class="inline-block mt-2 px-4 py-1 text-xs font-semibold text-white bg-red-600 rounded-full">
                            Sold Out
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-600">There are no events available.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $events->links('pagination::tailwind') }}
    </div>
</div>
@endsection
