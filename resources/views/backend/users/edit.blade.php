@extends('backend.layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">✏️ Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" name="name" id="name" class="w-full border p-2 rounded" value="{{ $user->name }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded" value="{{ $user->email }}" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium">Role</label>
            <select name="role" id="role" class="w-full border p-2 rounded" required>
            <option value="alumni" @selected($user->role === 'alumni')>Alumni</option>
            <option value="admin" @selected($user->role === 'admin')>Admin</option>

            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update User</button>
    </form>
</div>
@endsection
