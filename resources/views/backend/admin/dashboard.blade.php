@extends('backend.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-600 mt-1">Here's what's happening with your alumni system today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Users Card -->
        <div class="bg-gradient-to-br from-ist-red to-red-700 rounded-xl shadow-lg text-white overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Total Users</p>
                        <p class="text-3xl font-bold mt-2">{{ $usersCount }}</p>
                        <p class="text-red-100 text-xs mt-1">Registered alumni</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Card -->
        <div class="bg-gradient-to-br from-ist-dark to-gray-800 rounded-xl shadow-lg text-white overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium">Total Events</p>
                        <p class="text-3xl font-bold mt-2">{{ $eventsCount }}</p>
                        <p class="text-gray-300 text-xs mt-1">All events created</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registrations Card -->
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-xl shadow-lg text-white overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium">Event Registrations</p>
                        <p class="text-3xl font-bold mt-2">{{ $registrationsCount }}</p>
                        <p class="text-gray-300 text-xs mt-1">Total registrations</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.events.index') }}" class="group bg-gradient-to-r from-ist-red to-red-600 hover:from-red-600 hover:to-ist-red text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-10 h-10 mx-auto mb-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-semibold text-lg">Manage Events</span>
                <p class="text-red-100 text-sm mt-1">Create and edit events</p>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="group bg-gradient-to-r from-ist-dark to-gray-700 hover:from-gray-700 hover:to-ist-dark text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-10 h-10 mx-auto mb-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <span class="font-semibold text-lg">Manage Users</span>
                <p class="text-gray-300 text-sm mt-1">View and approve users</p>
            </a>
            
            <a href="{{ route('admin.donations.index') }}" class="group bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-500 hover:to-gray-600 text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-10 h-10 mx-auto mb-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                <span class="font-semibold text-lg">View Donations</span>
                <p class="text-gray-300 text-sm mt-1">Track contributions</p>
            </a>
            
            <a href="{{ route('home') }}" class="group bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-400 hover:to-gray-500 text-white p-6 rounded-lg text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-10 h-10 mx-auto mb-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-semibold text-lg">Back to Site</span>
                <p class="text-gray-300 text-sm mt-1">View frontend</p>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Activity</h3>
        <div class="space-y-4">
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                <div class="bg-ist-red p-2 rounded-full">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">New user registered</p>
                    <p class="text-xs text-gray-500">2 minutes ago</p>
                </div>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                <div class="bg-ist-dark p-2 rounded-full">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Event registration received</p>
                    <p class="text-xs text-gray-500">1 hour ago</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
