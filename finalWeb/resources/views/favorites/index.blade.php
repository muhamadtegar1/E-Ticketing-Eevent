@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Acara Favorit Saya</h2>
    @if($favorites->count())
        <div class="row">
            @foreach($favorites as $event)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="card-text"><small class="text-muted">{{ $event->location }}</small></p>
                            <form action="{{ route('favorites.destroy', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus dari Favorit</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $favorites->links() }}
    @else
        <p>Anda belum memiliki acara favorit.</p>
    @endif
</div>
@endsection
