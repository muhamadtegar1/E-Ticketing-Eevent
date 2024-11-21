@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Acara Anda</h2>
    <a href="{{ route('events.create') }}" class="btn btn-success mb-3">Tambah Acara</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Acara</th>
                <th>Tanggal Mulai</th>
                <th>Lokasi</th>
                <th>Harga Tiket</th>
                <th>Kuota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->datetime_start }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->ticket_price }}</td>
                <td>{{ $event->ticket_quota }}</td>
                <td>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
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
