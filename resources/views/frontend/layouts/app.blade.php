<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Alumni System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-700 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <div class="text-lg font-semibold">🎓 Alumni System</div>
            <div>
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline mr-4">Admin Dashboard</a>
                    @elseif (Auth::user()->role === 'alumni')
                        <a href="{{ route('alumni.dashboard') }}" class="hover:underline mr-4">Alumni Dashboard</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="hover:underline mr-4">Profile</a>
                    <a href="{{ route('settings.index') }}" class="hover:underline mr-4">Settings</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8">
        @yield('content')
    </main>

    <footer class="bg-gray-200 mt-12 p-4 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} Alumni System. All rights reserved.
    </footer>

</body>
</html>
