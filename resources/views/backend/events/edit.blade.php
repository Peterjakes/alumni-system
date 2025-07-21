@extends('layouts.frontend')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Event</h2>
<form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $event->title }}" required class="w-full border px-3 py-2">
    <textarea name="description" required class="w-full border px-3 py-2">{{ $event->description }}</textarea>
    <input type="date" name="event_date" value="{{ $event->event_date->format('Y-m-d') }}" required class="w-full border px-3 py-2">
    <input type="text" name="location" value="{{ $event->location }}" required class="w-full border px-3 py-2">
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
