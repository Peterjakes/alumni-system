@extends('backend.layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Create New Event</h2>
                <p class="text-gray-600 mt-2">Add a new event for the alumni community</p>
            </div>
            <a href="{{ route('admin.events.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Events
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-heading text-ist-red mr-2"></i>Event Title
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-ist-red focus:border-ist-red transition duration-200 @error('title') border-red-500 @enderror"
                           placeholder="Enter a compelling event title">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Location --}}
                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-map-marker-alt text-ist-red mr-2"></i>Location
                    </label>
                    <input type="text" 
                           id="location" 
                           name="location" 
                           value="{{ old('location') }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-ist-red focus:border-ist-red transition duration-200 @error('location') border-red-500 @enderror"
                           placeholder="Where will the event take place?">
                    @error('location')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- Event Date --}}
            <div>
                <label for="event_date" class="block text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-calendar-alt text-ist-red mr-2"></i>Event Date & Time
                </label>
                <input type="datetime-local" 
                       id="event_date" 
                       name="event_date" 
                       value="{{ old('event_date') }}"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-ist-red focus:border-ist-red transition duration-200 @error('event_date') border-red-500 @enderror">
                @error('event_date')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-align-left text-ist-red mr-2"></i>Event Description
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="6"
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-ist-red focus:border-ist-red transition duration-200 @error('description') border-red-500 @enderror"
                          placeholder="Provide a detailed description of the event, including agenda, speakers, and what attendees can expect...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Image Upload --}}
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-image text-ist-red mr-2"></i>Event Image
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-ist-red transition duration-200">
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*"
                           class="hidden"
                           onchange="previewImage(this)">
                    <label for="image" class="cursor-pointer">
                        <div id="image-preview" class="hidden mb-4">
                            <img id="preview-img" src="/placeholder.svg" alt="Preview" class="max-w-xs mx-auto rounded-lg shadow-md">
                        </div>
                        <div id="upload-placeholder">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-lg font-medium text-gray-600">Click to upload event image</p>
                            <p class="text-sm text-gray-500 mt-2">JPEG, PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </label>
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Submit Buttons --}}
            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                <a href="{{ route('admin.events.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="bg-gradient-to-r from-ist-red to-red-700 hover:from-red-700 hover:to-ist-red text-white px-8 py-3 rounded-lg transition duration-200 flex items-center shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Create Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
