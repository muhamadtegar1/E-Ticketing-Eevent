@extends('layouts.user')

@section('title', 'Favorit Saya')

@section('content')
<div class="container mx-auto p-4">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Favorite Events</h1>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg p-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('info'))
        <div class="mb-4 text-sm text-blue-700 bg-blue-100 border border-blue-400 rounded-lg p-4">
            {{ session('info') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded-lg p-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Favorites List Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Event Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Location</th>
                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Datetime</th>
                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-bold">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($favorites as $favorite)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-left text-gray-800">
                            {{ $favorite->name ?? 'Nama tidak tersedia' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-left text-gray-600 text-center">
                            {{ $favorite->location ?? 'Lokasi tidak tersedia' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-left text-gray-600 text-center">
                            @if ($favorite->datetime_start)
                                {{ \Carbon\Carbon::parse($favorite->datetime_start)->format('d M Y H:i') }}
                            @else
                                Date not available
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <form action="{{ route('user.favorites.destroy', $favorite->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="px-3 py-1 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-600">You don't have a favorite event yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
