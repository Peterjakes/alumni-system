@extends('frontend.layouts.app')

@section('title', 'Welcome to Alumni System')

@section('content')
{{-- Hero Section - Updated to fill viewport and touch navigation bar --}}
<div class="relative bg-cover bg-center min-h-screen flex items-center text-white" style="background-image: url('https://plus.unsplash.com/premium_photo-1663089053386-5f8ffc503ea4?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fGFsdW1uaXxlbnwwfHwwfHx8MA%3D%3D');">
    <div class="absolute inset-0 bg-black opacity-60"></div> {{-- Overlay --}}
    <div class="container mx-auto relative z-10 text-center px-4">
        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
            Connect, Engage, Thrive<br>Your Alumni Network Awaits
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto">
            Stay connected with your alma mater, discover events, and grow your professional network.
        </p>
        <a href="{{ route('register') }}" class="inline-block bg-ist-red hover:bg-ist-red-darker text-white text-lg font-semibold py-3 px-8 rounded-lg transition duration-300">
            JOIN OUR COMMUNITY
        </a>
    </div>
</div>

{{-- About Section - Original content, themed with ist-red for stats --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">About Our Alumni Community</h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-8">
            Our alumni network is a vibrant community of successful professionals who have graduated from our esteemed institution. We foster connections, facilitate mentorship, and celebrate the achievements of our graduates. Join us to stay connected, give back, and grow your network.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
            <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                <h3 class="text-2xl font-bold text-ist-red mb-2">{{ $totalAlumni ?? 'XXX' }}</h3>
                <p class="text-gray-700">Total Alumni</p>
            </div>
            <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                <h3 class="text-2xl font-bold text-ist-red mb-2">{{ $eventsThisYear ?? 'XX' }}</h3>
                <p class="text-gray-700">Events This Year</p>
            </div>
            <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                <h3 class="text-2xl font-bold text-ist-red mb-2">XX</h3>
                <p class="text-gray-700">Success Stories</p>
            </div>
        </div>
    </div>
</section>

{{-- Upcoming Events Section - Original content, themed with ist-red for button --}}
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Upcoming Events</h2>
        @if($upcomingEvents->isEmpty())
            <p class="text-center text-gray-600">No upcoming events at the moment. Check back soon!</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($upcomingEvents as $event)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($event->image_url)
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                        @else
                            <img src="/placeholder.svg?height=192&width=384&text=Event%20Banner" alt="Event Banner" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($event->description, 100) }}</p>
                            <p class="text-gray-700 text-sm mb-2"><strong class="font-medium">Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</p>
                            <p class="text-gray-700 text-sm mb-4"><strong class="font-medium">Location:</strong> {{ $event->location }}</p>
                            <a href="" class="inline-block bg-ist-red hover:bg-ist-red-darker text-white px-4 py-2 rounded-md text-sm">Register Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- Call to Action / Join Now Section - Original content, themed with ist-red --}}
<section class="py-16 bg-ist-red text-white text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4">Join Our Thriving Alumni Network Today!</h2>
        <p class="text-lg mb-8 max-w-3xl mx-auto">
            Connect with former classmates, discover new opportunities, and contribute to the growth of our community.
        </p>
        <a href="{{ route('register') }}" class="inline-block bg-white text-ist-red hover:bg-gray-100 font-semibold py-3 px-8 rounded-lg transition duration-300">
            Register Now
        </a>
        <p class="mt-6 text-sm">Already a member? <a href="{{ route('login') }}" class="underline hover:text-gray-200">Login here</a></p>
    </div>
</section>
@endsection