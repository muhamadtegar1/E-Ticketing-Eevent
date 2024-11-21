@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen Acara</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Acara</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Harga Tiket</th>
                <th>Kuota Tiket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->ticket_price }}</td>
                <td>{{ $event->ticket_quota }}</td>
                <td>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $events->links() }}
</div>
@endsection
