<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-700 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <div class="text-lg font-semibold">🎓 Alumni System</div>
        <div>
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="ml-4 hover:underline">Profile</a>
            <a href="{{ route('settings.index') }}" class="ml-4 hover:underline">Settings</a>
            <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        </div>
    </div>
</nav>

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>

    <footer class="bg-gray-200 mt-12 p-4 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} Alumni System. All rights reserved.
    </footer>

</body>
</html>
