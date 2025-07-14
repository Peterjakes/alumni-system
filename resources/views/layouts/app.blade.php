<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="bg-gray-800 p-4 text-white flex justify-between">
    <div>
        @auth
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="mr-4">Admin Dashboard</a>
            @elseif (Auth::user()->role === 'alumni')
                <a href="{{ route('alumni.dashboard') }}" class="mr-4">Alumni Dashboard</a>
            @endif
        @endauth
    </div>

    <div>
        @auth
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded">Login</a>
        @endauth
    </div>
</nav>

    </body>
</html>
