@extends('backend.layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">➕ Create New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" name="name" id="name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium">Role</label>
            <select name="role" id="role" class="w-full border p-2 rounded" required>
                <option value="admin">Admin</option>
                <option value="alumni">Alumni</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create User</button>
    </form>
</div>
@endsection
