@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Upcoming Events</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                {{-- Updated to clean card design with better spacing and styling --}}
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                    {{-- Event Image --}}
                    @if($event->image_url)
                        <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Card Content --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $event->title }}</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">{{ $event->description }}</p>
                        
                        {{-- Event Details --}}
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                                </svg>
                                <span><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span><strong>Location:</strong> {{ $event->location }}</span>
                            </div>
                        </div>

                        {{-- Registration Button --}}
                        @auth
                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Register
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="w-full block text-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200">
                                Login to Register
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Added empty state with better styling --}}
        <div class="text-center py-16">
            <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-600 mb-2">No Events Available</h3>
            <p class="text-gray-500">Check back soon for exciting upcoming events!</p>
        </div>
    @endif
</div>
@endsection
