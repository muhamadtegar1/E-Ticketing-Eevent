@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <h1>Welcome to E-Ticketing</h1>

    <form action="{{ route('events.search') }}" method="GET">
        <input type="text" name="name" placeholder="Search by event name">
        <select name="location">
            <option value="">Select location</option>
            <option value="Outdoor">Outdoor</option>
            <option value="Indoor">Indoor</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <h2>Latest Events</h2>
    <ul>
        @foreach ($events as $event)
            <li>
                <h3>{{ $event->name }}</h3>
                <p>{{ $event->location }} | {{ $event->datetime_start }}</p>
                <a href="{{ route('events.show', $event->id) }}">View Details</a>
            </li>
        @endforeach
    </ul>

    {{ $events->links() }}
@endsection
