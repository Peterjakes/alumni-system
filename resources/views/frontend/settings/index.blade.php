@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Settings</h1>
            <p class="text-gray-300">Manage your account preferences and security settings</p>
        </div>

        <div class="space-y-6">
            <!-- Added form wrapper for settings -->
            <form method="POST" action="{{ route('settings.update') }}">
                @csrf
                @method('PUT')
                
                <!-- Account Settings -->
                <div class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Account Settings
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Email Notifications -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-white">Email Notifications</h3>
                                <p class="text-gray-400">Receive notifications about events and updates</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="email_notifications" class="sr-only peer" {{ auth()->user()->email_notifications ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                            </label>
                        </div>

                        <!-- Event Reminders -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-white">Event Reminders</h3>
                                <p class="text-gray-400">Get reminded about upcoming events you've registered for</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="event_reminders" class="sr-only peer" {{ auth()->user()->event_reminders ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                            </label>
                        </div>

                        <!-- Newsletter -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-white">Newsletter</h3>
                                <p class="text-gray-400">Receive monthly alumni newsletter</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="newsletter" class="sr-only peer" {{ auth()->user()->newsletter ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Security Settings
                        </h2>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Change Password -->
                        <div class="p-4 bg-gray-700 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-medium text-white">Change Password</h3>
                                    <p class="text-gray-400">Update your account password</p>
                                </div>
                                <button onclick="togglePasswordForm()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    Change
                                </button>
                            </div>
                            
                            <!-- Password Change Form (Initially Hidden) -->
                            <div id="passwordForm" class="hidden mt-4 space-y-4">
                                <form method="POST" action="{{ route('settings.password') }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                                            <input type="password" name="current_password" required
                                                   class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                                            <input type="password" name="password" required
                                                   class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" required
                                                   class="w-full px-4 py-3 bg-gray-600 border border-gray-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600">
                                        </div>
                                        <div class="flex space-x-3">
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                                Update Password
                                            </button>
                                            <button type="button" onclick="togglePasswordForm()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors duration-200">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Two-Factor Authentication -->
                        <div class="flex items-center justify-between p-4 bg-gray-700 rounded-lg">
                            <div>
                                <h3 class="text-lg font-medium text-white">Two-Factor Authentication</h3>
                                <p class="text-gray-400">Add an extra layer of security to your account</p>
                            </div>
                            <button class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors duration-200">
                                Enable
                            </button>
                        </div>

                        <!-- Login Sessions -->
                        <div class="flex items-center justify-between p-4 bg-gray-700 rounded-lg">
                            <div>
                                <h3 class="text-lg font-medium text-white">Active Sessions</h3>
                                <p class="text-gray-400">Manage your active login sessions</p>
                            </div>
                            <button class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors duration-200">
                                View
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings -->
                <div class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Privacy Settings
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Profile Visibility -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-white">Profile Visibility</h3>
                                <p class="text-gray-400">Control who can see your profile information</p>
                            </div>
                            <select name="profile_visibility" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-600">
                                <option value="public" {{ auth()->user()->profile_visibility === 'public' ? 'selected' : '' }}>Public</option>
                                <option value="alumni_only" {{ auth()->user()->profile_visibility === 'alumni_only' ? 'selected' : '' }}>Alumni Only</option>
                                <option value="private" {{ auth()->user()->profile_visibility === 'private' ? 'selected' : '' }}>Private</option>
                            </select>
                        </div>

                        <!-- Contact Information -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-white">Contact Information</h3>
                                <p class="text-gray-400">Allow other alumni to see your contact details</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="contact_information" class="sr-only peer" {{ auth()->user()->contact_information ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Save Settings -->
                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 transform hover:scale-105 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
function togglePasswordForm() {
    const form = document.getElementById('passwordForm');
    form.classList.toggle('hidden');
}
</script>
