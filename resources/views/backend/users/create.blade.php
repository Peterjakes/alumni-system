@extends('backend.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New User</h1>

<form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block">Name</label>
        <input type="text" name="name" class="w-full border p-2" required>
    </div>
    <div>
        <label class="block">Email</label>
        <input type="email" name="email" class="w-full border p-2" required>
    </div>
    <div>
        <label class="block">Role</label>
        <select name="role" class="w-full border p-2" required>
            <option value="alumni">Alumni</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div>
        <label class="block">Password</label>
        <input type="password" name="password" class="w-full border p-2" required>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Create</button>
</form>
@endsection
