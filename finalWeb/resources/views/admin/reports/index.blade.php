@extends('layouts.admin')

@section('title', 'Laporan Penjualan Tiket')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Ticket Sales Report</h1>

    <!-- Canvas for Chart -->
    <canvas id="salesChart" class="w-full h-96"></canvas>

    <!-- Table for Backup -->
    <div class="overflow-x-auto mt-6">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="border border-gray-300 px-4 py-2 text-center">NO</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Event</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total Tickets</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $report->event->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $report->total_tickets }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ number_format($report->total_revenue, 2) }} IDR</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Data from PHP (passed to JavaScript)
    const labels = @json($reports->pluck('event.name'));
    const totalTickets = @json($reports->pluck('total_tickets'));
    const totalRevenue = @json($reports->pluck('total_revenue'));

    // Create Chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Tickets',
                    data: totalTickets,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Total Revenue (IDR)',
                    data: totalRevenue,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
@endsection
