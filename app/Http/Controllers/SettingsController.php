<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('frontend.settings.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        // Update notification preferences
        $user->update([
            'email_notifications' => $request->has('email_notifications'),
            'event_reminders' => $request->has('event_reminders'),
            'newsletter' => $request->has('newsletter'),
            'profile_visibility' => $request->profile_visibility ?? 'public',
            'contact_visible' => $request->has('contact_visible'),
        ]);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('settings.index')->with('success', 'Password changed successfully!');
    }
}
