@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Edit Profile</h1>
            <p class="text-gray-300">Update your personal information and preferences</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-600 border border-green-500 text-white px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-6 bg-red-600 border border-red-500 text-white px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Profile Form -->
        <div class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Personal Information
                </h2>
            </div>

            <form class="p-6 space-y-6" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <!-- Profile Photo -->
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        <img class="h-20 w-20 object-cover rounded-full border-4 border-red-600" 
                             src="{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : '/placeholder.svg?height=80&width=80' }}" 
                             alt="Profile photo">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Profile Photo</label>
                        <input type="file" name="profile_photo" accept="image/*" 
                               class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 file:cursor-pointer">
                    </div>
                </div>

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" 
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" 
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                </div>

                <!-- Graduation Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Graduation Year</label>
                    <select name="graduation_year" 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1980; $year--)
                            <option value="{{ $year }}" {{ (old('graduation_year', auth()->user()->graduation_year) == $year) ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Bio -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
                    <textarea name="bio" rows="4" placeholder="Tell us about yourself..." 
                              class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">{{ old('bio', auth()->user()->bio) }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                    <a href="{{ route('alumni.dashboard') }}" 
                       class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 transform hover:scale-105 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
