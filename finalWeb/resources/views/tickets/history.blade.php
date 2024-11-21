@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Pemesanan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Acara</th>
                <th>Tanggal Acara</th>
                <th>Status Tiket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->event->name }}</td>
                <td>{{ $ticket->event->date }}</td>
                <td>{{ $ticket->status }}</td>
                <td>
                    @if($ticket->status == 'active')
                    <form action="{{ route('tickets.cancel', $ticket->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Batalkan</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tickets->links() }}
</div>
@endsection
