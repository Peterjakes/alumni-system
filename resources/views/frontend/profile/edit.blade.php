@extends('layouts.frontend')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>

    {{-- Success message --}}
    @if (session('success') || session('status'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') ?? session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full mt-1 p-2 border rounded">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full mt-1 p-2 border rounded">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
