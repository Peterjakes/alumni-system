<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Alumni System'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom styles for the IST theme colors */
        .bg-ist-red { background-color: #E30613; }
        .text-ist-red { color: #E30613; }
        .bg-ist-dark { background-color: #1a1a1a; }
        .text-ist-light-gray { color: #cccccc; }
        .border-ist-red { border-color: #E30613; }
        .hover\:bg-ist-red-darker:hover { background-color: #c00510; }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    <!-- Top Red Bar -->
    <div class="bg-ist-red text-white text-xs py-2 px-4 md:px-8 flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center space-x-4 mb-1 md:mb-0">
            <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> info@alumni.com</span>
            <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Westpoint Building, Mpaka Road, Westlands, Nairobi</span>
        </div>
        <div>
            @auth
                <a href="{{ route('profile.edit') }}" class="hover:underline mr-4">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline mr-4">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="bg-white shadow-md py-4 px-4 md:px-8">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="https://www.isteducation.com/ist-content/uploads/2022/02/cropped-IST-logo-01-2048x2048-1-2.png" alt="IST College Logo" class="h-10 mr-3">
                    <span class="text-xl font-bold text-gray-800 hidden md:block">Alumni System</span>
                </a>
            </div>
            <div class="hidden md:flex space-x-6 text-gray-700 font-semibold">
    <a href="{{ route('home') }}" class="hover:text-ist-red">Home</a>
    <a href="{{ route('events.index') }}" class="hover:text-ist-red">Events</a>

    <a href="{{ route('donations.create') }}" class="hover:text-ist-red">Payments</a>
    <a href="{{ route('settings.index') }}" class="hover:text-ist-red">Settings</a>
    <a href="{{ route('profile.edit') }}" class="hover:text-ist-red">Profile</a>
    @auth
        <a href="{{ route('alumni.dashboard') }}" class="hover:text-ist-red">Dashboard</a>
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="hover:text-ist-red">Admin Panel</a>
        @endif
    @endauth
</div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden bg-white py-2 shadow-lg">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Home</a>
            <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Events</a>
            @auth
                <a href="{{ route('alumni.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dashboard</a>
               
                <a href="{{ route('donations.create') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Payments</a>
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Admin Panel</a>
                @endif
            @endauth
            <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Settings</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Register</a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-ist-dark text-ist-light-gray py-10 mt-12">
        <div class="container mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Column 1: Quick Links -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    <li><a href="" class="hover:text-white">Events</a></li>
                    
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-white">Profile</a></li>
                    <li><a href="{{ route('donations.create') }}" class="hover:text-white">Donate</a></li>
                    <li><a href="{{ route('settings.index') }}" class="hover:text-white">Settings</a></li>
                    <!-- Add other relevant links like About Us, Privacy Policy if you create them -->
                </ul>
            </div>

            <!-- Column 2: Follow Us -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Follow Us</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.27 0-4.192 2.159-4.192 4.926v2.074z"/></svg> Facebook</a></li>
                    <li><a href="#" class="hover:text-white flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.779 1.673 4.927 4.927.058 1.265.069 1.645.069 4.849 0 3.204-.012 3.584-.069 4.849-.149 3.252-1.673 4.779-4.927 4.927-1.264.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.069-3.251-.149-4.778-1.673-4.927-4.927-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.584.069-4.849.149-3.251 1.673-4.778 4.927-4.927 1.264-.057 1.644-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.073 4.948.073 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg> Instagram</a></li>
                    <li><a href="#" class="hover:text-white flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.403 0-6.162 2.759-6.162 6.162 0 .483.055.953.154 1.403-5.125-.257-9.661-2.712-12.707-6.417-.525.907-.828 1.962-.828 3.227 0 2.136 1.086 4.027 2.741 5.132-.807-.025-1.566-.247-2.229-.616v.086c0 2.987 2.12 5.473 4.923 6.04-.518.142-1.063.215-1.62.215-.398 0-.783-.038-1.158-.111.78 2.435 3.04 4.213 5.713 4.262-2.093 1.64-4.738 2.62-7.615 2.62-.495 0-.98-.029-1.458-.085 2.705 1.735 5.93 2.75 9.36 2.75 11.238 0 17.36-9.319 17.36-17.36 0-.264-.008-.528-.019-.797.798-.578 1.49-1.299 2.04-2.124z"/></svg> Twitter</a></li>
                    <li><a href="#" class="hover:text-white flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg> LinkedIn</a></li>
                </ul>
            </div>

            <!-- Column 3: Contact Us -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Contact Us</h3>
                <ul class="space-y-2">
                    <li><span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> +254 739 944 882</span></li>
                    <li><span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg> Whatsapp</span></li>
                    <li><span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> info@alumni.com</span></li>
                    <li><span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Westpoint Building, 6th Floor, Mpaka Road, Westlands, Nairobi</span></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-xs mt-8 border-t border-gray-700 pt-4">
            &copy; {{ date('Y') }} Alumni System. All rights reserved.
        </div>
    </footer>

    <script>
        // JavaScript for mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>