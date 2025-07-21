@extends('backend.layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Users</h3>
            <p class="text-2xl">{{ $usersCount }}</p>
        </div>

        <div class="bg-green-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Events</h3>
            <p class="text-2xl">{{ $eventsCount }}</p>
        </div>

        <div class="bg-yellow-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Registrations</h3>
            <p class="text-2xl">{{ $registrationsCount }}</p>
        </div>
    </div>
</div>
@endsection
