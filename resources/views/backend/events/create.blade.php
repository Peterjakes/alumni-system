@extends('layouts.frontend')


@section('content')
<h2 class="text-xl font-bold mb-4">Create Event</h2>
<form action="{{ route('events.store') }}" method="POST" class="space-y-4">
    @csrf
    <input type="text" name="title" placeholder="Title" required class="w-full border px-3 py-2">
    <textarea name="description" placeholder="Description" required class="w-full border px-3 py-2"></textarea>
    <input type="date" name="event_date" required class="w-full border px-3 py-2">
    <input type="text" name="location" placeholder="Location" required class="w-full border px-3 py-2">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
</form>
@endsection
