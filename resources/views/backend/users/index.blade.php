@extends('backend.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">User List</h1>

<a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">➕ Add New User</a>

<table class="w-full mt-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $user->name }}</td>
            <td class="px-4 py-2">{{ $user->email }}</td>
            <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
            <td class="px-4 py-2 space-x-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600">Edit</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600" onclick="return confirm('Delete this user?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
