<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Ticketing')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            @auth
                @if (auth()->user()->hasRole('admin'))
                    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                @elseif (auth()->user()->hasRole('organizer'))
                    <li><a href="{{ route('organizer.dashboard') }}">Organizer Dashboard</a></li>
                @else
                    <li><a href="{{ route('user.dashboard') }}">User Dashboard</a></li>
                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2024 E-Ticketing. All rights reserved.</p>
    </footer>
</body>
</html>
