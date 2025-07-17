@extends('backend.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit User</h1>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block">Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2" required>
    </div>
    <div>
        <label class="block">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2" required>
    </div>
    <div>
        <label class="block">Role</label>
        <select name="role" class="w-full border p-2" required>
            <option value="alumni" @selected($user->role === 'alumni')>Alumni</option>
            <option value="admin" @selected($user->role === 'admin')>Admin</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
