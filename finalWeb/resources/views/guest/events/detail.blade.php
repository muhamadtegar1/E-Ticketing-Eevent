@extends('layouts.app')

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
        <div class="mt-6">
            @auth
                <a href="{{ route('user.bookings.store', $event->id) }}" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 block text-center">
                    Book Ticket
                </a>
            @else
                <a href="{{ route('auth.login') }}" class="w- bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 block text-center">
                    Login to Book Tickets
                </a>
            @endauth
        </div>
    </div>
@endsection
