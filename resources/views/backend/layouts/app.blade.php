<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - @yield('title', 'Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-ist-red { background-color: #E30613; }
        .text-ist-red { color: #E30613; }
        .bg-ist-dark { background-color: #1a1a1a; }
        .hover\:bg-ist-red-darker:hover { background-color: #c00510; }
        .border-ist-red { border-color: #E30613; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Top Navbar --}}
    <header class="bg-ist-red shadow-lg">
        <div class="flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            <div class="flex items-center space-x-4">
                <span class="text-white">Welcome, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-white text-ist-red px-4 py-2 rounded hover:bg-gray-100 transition duration-200">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- Sidebar + Content --}}
    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-ist-dark text-white min-h-screen">
            <div class="p-4">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-300">Navigation</h2>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 block hover:bg-ist-red p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-ist-red' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 block hover:bg-ist-red p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-ist-red' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="flex items-center space-x-3 block hover:bg-ist-red p-3 rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Events</span>
                    </a>
                    <a href="{{ route('admin.donations.index') }}" class="flex items-center space-x-3 block hover:bg-ist-red p-3 rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <span>Donations</span>
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 block hover:bg-ist-red p-3 rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Back to Site</span>
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Page Content --}}
        <main class="flex-1 p-6 bg-gray-50 min-h-screen">
            @yield('content')
        </main>
    </div>

</body>
</html>
