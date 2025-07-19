@extends('layouts.frontend')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6">Change Password</h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="current_password" class="block text-sm font-medium">Current Password</label>
            <input id="current_password" name="current_password" type="password" required
                class="w-full mt-1 p-2 border rounded">
            @error('current_password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium">New Password</label>
            <input id="password" name="password" type="password" required
                class="w-full mt-1 p-2 border rounded">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="w-full mt-1 p-2 border rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update Password
            </button>
        </div>
    </form>
</div>
@endsection
