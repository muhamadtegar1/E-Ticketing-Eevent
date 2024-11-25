@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Events</h5>
                    <p class="card-text">{{ $totalEvents }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tickets Sold</h5>
                    <p class="card-text">{{ $ticketsSold }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">${{ $totalRevenue }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
