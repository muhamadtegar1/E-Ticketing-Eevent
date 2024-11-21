@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Penjualan Tiket</h2>
    <canvas id="salesChart" width="400" height="200"></canvas>
</div>

<script src="<https://cdn.jsdelivr.net/npm/chart.js>"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const analyticsData = @json($analytics);

    const labels = analyticsData.map(item => item.event.name);
    const data = analyticsData.map(item => item.total_tickets_sold);

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tiket Terjual',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
