<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar bg-light p-3">
            <h5>Admin Panel</h5>
            <ul class="list-unstyled">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
                <li><a href="{{ route('admin.events.index') }}">Manage Events</a></li>
                <li><a href="{{ route('admin.reports.index') }}">Reports</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </nav>
        <div class="content p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
