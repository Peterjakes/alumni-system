@extends('frontend.layouts.app')

@section('title', 'Alumni Directory')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Alumni Directory</h1>
                <p class="text-gray-600 mt-2">Connect with fellow alumni from our community</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Total Alumni</p>
                <p class="text-2xl font-bold text-ist-red">{{ $alumni->total() }}</p>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('alumni.directory') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search by name..." 
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ist-red focus:border-transparent">
            </div>
            <div class="md:w-48">
                <select name="graduation_year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ist-red focus:border-transparent">
                    <option value="">All Years</option>
                    @for($year = date('Y'); $year >= 1990; $year--)
                        <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>
                            Class of {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="bg-ist-red hover:bg-ist-red-darker text-white px-6 py-2 rounded-lg transition duration-200">
                Search
            </button>
        </form>
    </div>

    {{-- Alumni Grid --}}
    @if($alumni->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No alumni found</h3>
            <p class="text-gray-500">Try adjusting your search criteria.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($alumni as $alumnus)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                @if($alumnus->profile_photo_path)
                                    {{-- Fixed profile photo path to use proper storage asset URL --}}
                                    <img src="{{ asset('storage/' . $alumnus->profile_photo_path) }}" alt="{{ $alumnus->name }}" 
                                         class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <div class="w-16 h-16 bg-ist-red bg-opacity-10 rounded-full flex items-center justify-center">
                                        <span class="text-ist-red font-semibold text-xl">{{ substr($alumnus->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $alumnus->name }}</h3>
                                <p class="text-sm text-gray-500">Class of {{ $alumnus->graduation_year ?? 'N/A' }}</p>
                                @if($alumnus->email)
                                    <p class="text-sm text-gray-400 truncate">{{ $alumnus->email }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active Member
                            </span>
                            @if($alumnus->phone)
                                <div class="flex items-center text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-sm">{{ $alumnus->phone }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            {{ $alumni->links() }}
        </div>
    @endif
</div>
@endsection
