@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pemesanan untuk Acara: {{ $event->name }}</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Status Tiket</th>
                <th>Tanggal Pemesanan</th>
                <th>Tanggal Pembatalan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $ticket)
            <tr>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->booking_date }}</td>
                <td>{{ $ticket->cancel_date ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bookings->links() }}
</div>
@endsection
