@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Create Event</a>
    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $event->image_URL }}" class="card-img-top" alt="{{ $event->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text">
                            Location: {{ $event->location }}<br>
                            Date: {{ $event->datetime_start }}<br>
                            Price: ${{ $event->ticket_price }}
                        </p>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $events->links() }}
</div>
@endsection
