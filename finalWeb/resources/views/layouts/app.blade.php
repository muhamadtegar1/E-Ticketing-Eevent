<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Ticketing')</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('build\assets\logoticket.png') }}" alt="E-Ticketing Logo" class="h-8">
                <span class="text-xl font-bold text-gray-800">e-Ticket</span>
            </div>

            <!-- Hamburger Menu -->
            <div class="sm:hidden">
                <button 
                    @click="open = !open"
                    class="text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div :class="{'block': open, 'hidden': !open}" class="hidden sm:flex space-x-6 items-center">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-500 font-bold">Home</a>
                @auth
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-500">Admin Dashboard</a>
                    @elseif (auth()->user()->hasRole('organizer'))
                        <a href="{{ route('organizer.dashboard') }}" class="text-gray-600 hover:text-blue-500">Organizer Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-blue-500">User Dashboard</a>
                    @endif
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-600 hover:text-red-800">
                        Logout
                    </a>
                @else
                    <a href="{{ route('auth.login') }}" class="text-gray-600 hover:text-blue-500 font-bold">Login</a>
                    <a href="{{ route('auth.register') }}" class="text-gray-600 hover:text-green-500 font-bold">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-6 mt-20">
        @yield('content')
    </div>
</body>
</html>
