@extends('backend.layouts.app')

@section('title', 'Manage Events')

@section('content')
<!-- Simplified header with proper red and black theme -->
<div class="bg-black rounded-lg p-6 mb-6 border border-red-600 shadow-lg">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">All Events</h1>
            <p class="text-gray-300">Manage and organize your alumni events</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Event
        </a>
    </div>
</div>

@if(session('success'))
    <!-- Simplified success message styling -->
    <div class="bg-green-600 text-white px-6 py-4 rounded-lg mb-6 flex items-center shadow-lg">
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        {{ session('success') }}
    </div>
@endif

<!-- Clean table container with red and black theme -->
<div class="bg-gray-900 rounded-lg shadow-xl overflow-hidden border border-gray-700">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <!-- Clean table header with red accents -->
            <thead class="bg-black">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider border-b border-red-600">Title</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider border-b border-red-600">Date</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider border-b border-red-600">Location</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider border-b border-red-600">Image</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider border-b border-red-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($events as $event)
                    <!-- Clean row styling with proper hover effects -->
                    <tr class="hover:bg-gray-800 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="text-white font-semibold text-lg">{{ $event->title }}</div>
                            @if($event->description)
                                <div class="text-gray-400 text-sm mt-1">{{ Str::limit($event->description, 60) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-white font-medium">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                            </div>
                            <div class="text-gray-400 text-sm">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('g:i A') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center text-gray-300">
                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $event->location }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($event->image_url)
                                <img src="{{ asset('storage/' . $event->image_url) }}" alt="Event Image" class="w-16 h-12 object-cover rounded border border-gray-600">
                            @else
                                <div class="w-16 h-12 bg-red-600 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <!-- Clean action buttons with proper theme colors -->
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.events.edit', $event->id) }}" 
                                   class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded text-sm font-medium transition duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-medium transition duration-200 flex items-center"
                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <!-- Clean empty state with proper theme -->
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="text-gray-400">
                                <div class="bg-gray-800 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-600">
                                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">No events found</h3>
                                <p class="text-gray-400 mb-6">Start by creating your first event to engage with alumni</p>
                                <a href="{{ route('admin.events.create') }}" 
                                   class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Create Your First Event
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($events->hasPages())
        <!-- Clean pagination styling -->
        <div class="bg-black px-6 py-4 border-t border-gray-700">
            <div class="flex justify-center">
                {{ $events->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
