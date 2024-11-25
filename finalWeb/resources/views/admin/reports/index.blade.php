@extends('layouts.admin')

@section('title', 'Sales Reports')

@section('content')
<div class="container">
    <h1 class="my-4">Sales Reports</h1>
    <canvas id="salesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($reportData['labels']),
            datasets: [{
                label: 'Tickets Sold',
                data: @json($reportData['data']),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
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
