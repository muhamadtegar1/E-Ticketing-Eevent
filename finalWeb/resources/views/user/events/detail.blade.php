@extends('layouts.user')

@section('title', $event->name)

@section('content')
<div class="container mx-auto p-4">
    <!-- Event Header -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $event->name }}</h1>
    </div>

    <!-- Event Image -->
    <div class="mb-6">
        <img 
            src="{{ $event->image_URL }}" 
            alt="{{ $event->name }}" 
            class="w-full max-h-[300px] object-cover rounded-lg shadow-md"
        >
    </div>

    <!-- Event Details -->
    <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <p>
            <strong class="font-semibold text-gray-700">Description :</strong> 
            <span class="text-gray-600">{{ $event->description }}</span>
        </p>
        <p>
            <strong class="font-semibold text-gray-700">Location :</strong> 
            <span class="text-gray-600">{{ $event->location }}</span>
        </p>
        <p>
            <strong class="font-semibold text-gray-700">Datetime :</strong> 
            <span class="text-gray-600">
                {{ \Carbon\Carbon::parse($event->datetime_start)->format('d M Y H:i') }} - 
                {{ \Carbon\Carbon::parse($event->datetime_end)->format('H:i') }}
            </span>
        </p>
        <p>
            <strong class="font-semibold text-gray-700">Ticket Price :</strong> 
            <span class="text-gray-600">{{ number_format($event->ticket_price, 0, ',', '.') }} IDR</span>
        </p>
        <p>
            <strong class="font-semibold text-gray-700">Available Ticket :</strong> 
            <span class="{{ $event->available_ticket > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $event->available_ticket > 0 ? $event->available_ticket . ' tersedia' : 'Sold Out' }}
            </span>
        </p>
    </div>

    <!-- Actions -->
    @auth
        @if (auth()->user()->hasRole('user'))
            <div class="mt-6 space-y-4">
                @if ($event->available_ticket > 0)
                    <form action="{{ route('user.bookings.store', $event->id) }}" method="POST" class="text-center">
                        @csrf
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Book Ticket
                        </button>
                    </form>
                @else
                    <p class="text-center text-red-600 font-semibold">Sold Out</p>
                @endif

                <form action="{{ route('user.favorites.store', $event->id) }}" method="POST" class="text-center">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-4 py-2 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Add Favorites
                    </button>
                </form>
            </div>
        @endif
    @else
        <div class="flex justify-center">
            <a 
                href="{{ route('auth.login') }}" 
                class="w-1/4 px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-center"
            >
                Login to Book Tickets
            </a>
        </div>    
    @endauth
</div>
@endsection
