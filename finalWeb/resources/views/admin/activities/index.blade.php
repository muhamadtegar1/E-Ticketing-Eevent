@extends('layouts.admin')

@section('title', 'User Activities')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">User Activities</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300">
            <!-- Header Tabel -->
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="border border-gray-300 px-4 py-2 text-center">User</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Activity</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Date</th>
                </tr>
            </thead>
            <!-- Konten Tabel -->
            <tbody>
                @forelse ($activities as $activity)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $activity->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $activity->activity }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $activity->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                        No activities recorded.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $activities->links('pagination::tailwind') }}
    </div>
</div>
@endsection
