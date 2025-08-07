{{-- resources/views/backend/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - @yield('title', 'Admin')</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Top Navbar --}}
    <header class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">Admin Panel</h1>
    </header>

    {{-- Sidebar + Content --}}
    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block hover:bg-gray-700 p-2 rounded">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block hover:bg-gray-700 p-2 rounded">Users</a>
                <a href="{{ route('admin.donations.index') }}" class="block py-2 px-4 hover:bg-gray-200">Donations</a>
            </nav>
        </aside>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
    

</body>
</html>
