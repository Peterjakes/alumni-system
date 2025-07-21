@extends('layouts.frontend')

@section('content')
<h2 class="text-xl font-bold mb-4">Upcoming Events</h2>

@foreach($events as $event)
    <div class="border p-4 mb-4">
        <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
        <p>{{ $event->description }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>

        @auth
        <form action="{{ route('events.register', $event->id) }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Register</button>
        </form>
        @endauth
    </div>
@endforeach
@endsection
