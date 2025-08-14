@extends('frontend.layouts.app')

@section('title', 'Alumni Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header -->
    <div class="bg-gradient-to-r from-ist-red to-red-800 shadow-2xl">
        <div class="container mx-auto px-6 py-8">
            <h1 class="text-4xl font-bold text-white">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-red-100 mt-2">Your alumni dashboard</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Profile Status -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-2xl border border-gray-700 hover:border-ist-red transition-all duration-300 transform hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Profile Status</p>
                            <p class="text-3xl font-bold text-green-400 mt-2">Active</p>
                        </div>
                        <div class="bg-ist-red p-3 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Network Status -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-2xl border border-gray-700 hover:border-ist-red transition-all duration-300 transform hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Network</p>
                            <p class="text-3xl font-bold text-blue-400 mt-2">Connected</p>
                        </div>
                        <div class="bg-ist-red p-3 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Member Since -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-2xl border border-gray-700 hover:border-ist-red transition-all duration-300 transform hover:scale-105">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Member Since</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ Auth::user()->created_at->format('Y') }}</p>
                        </div>
                        <div class="bg-ist-red p-3 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-2xl border border-gray-700 p-8 mb-8">
            <h2 class="text-2xl font-bold text-white mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('alumni.directory') }}" class="bg-gradient-to-r from-ist-red to-red-700 hover:from-red-700 hover:to-ist-red text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="font-semibold">Alumni Directory</span>
                </a>
                
                <a href="{{ route('events.index') }}" class="bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-semibold">View Events</span>
                </a>
                
                <a href="{{ route('donations.create') }}" class="bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    <span class="font-semibold">Make Donation</span>
                </a>
                
                <a href="{{ route('profile.edit') }}" class="bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-semibold">Update Profile</span>
                </a>
            </div>
        </div>

        <!-- Welcome Message -->
        <div class="bg-gradient-to-r from-ist-red to-red-800 rounded-xl shadow-2xl p-8 text-white text-center">
            <h2 class="text-3xl font-bold mb-4">Welcome to Your Alumni Network</h2>
            <p class="text-red-100 text-lg mb-6">Stay connected, discover opportunities, and contribute to your alma mater's growth.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('events.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 backdrop-blur-sm">
                    Explore Events
                </a>
                <a href="{{ route('donations.create') }}" class="bg-white text-ist-red hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                    Support Now
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
