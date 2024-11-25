@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Event</h1>
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Event Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="datetime_start">Start Date & Time</label>
            <input type="datetime-local" name="datetime_start" id="datetime_start" class="form-control" value="{{ $event->datetime_start->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="datetime_end">End Date & Time</label>
            <input type="datetime-local" name="datetime_end" id="datetime_end" class="form-control" value="{{ $event->datetime_end->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $event->location }}" required>
        </div>
        <div class="form-group">
            <label for="ticket_price">Ticket Price</label>
            <input type="number" step="0.01" name="ticket_price" id="ticket_price" class="form-control" value="{{ $event->ticket_price }}" required>
        </div>
        <div class="form-group">
            <label for="ticket_quota">Ticket Quota</label>
            <input type="number" name="ticket_quota" id="ticket_quota" class="form-control" value="{{ $event->ticket_quota }}" required>
        </div>
        <div class="form-group">
            <label for="image_URL">Event Image</label>
            <input type="file" name="image_URL" id="image_URL" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
