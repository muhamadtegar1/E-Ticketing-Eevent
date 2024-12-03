<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Organizer Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-3 px-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('build\assets\logoticket.png') }}" alt="E-Ticketing Logo" class="h-8">
                <span class="text-xl font-bold text-gray-800">e-Ticket</span>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="block lg:hidden">
                <button id="hamburger-menu" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Menu Items -->
            <ul id="nav-menu" class="hidden lg:flex space-x-6 items-center">
                <li>
                    <a href="{{ route('organizer.events.index') }}" class=" font-bold flex items-center py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('organizer.tickets.index') }}" class=" font-bold flex items-center py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                        
                    Bookings
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="flex items-center py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="red">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/>
                    </svg>
                 </a>
                 
                </li>                    
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-gray-50 shadow-md">
            <ul class="space-y-2 p-4">
                <li>
                    <a href="{{ route('organizer.events.index') }}" class="block text-gray-600 hover:text-blue-500">
                        Manage Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('organizer.tickets.index') }}" class="block text-gray-600 hover:text-blue-500">
                        Manage Bookings
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block text-gray-600 hover:text-red-500">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto mt-24 p-4">
        <header class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
        </header>
        <div>
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script>
        const hamburger = document.getElementById('hamburger-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
