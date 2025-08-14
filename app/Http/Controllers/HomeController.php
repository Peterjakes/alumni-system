<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import User model
use App\Models\Event; // Import Event model

class HomeController extends Controller
{
    /**
     * Display the public homepage or redirect to dashboard if logged in.
     * Fetches data for the public homepage sections.
     */
    public function index()
    {
        // If user is authenticated, redirect to their respective dashboard
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'alumni') {
                return redirect()->route('alumni.dashboard');
            }
        }

        // Data for the public homepage (before login)
        $totalAlumni = User::where('role', 'alumni')->where('status', 'approved')->count();
        $upcomingEvents = Event::where('event_date', '>', now())
                              ->orderBy('event_date', 'asc')
                              ->take(3) // Get next 3 public events
                              ->get();
        $eventsThisYear = Event::whereYear('event_date', date('Y'))->count(); // Count events for current year

        // Return a public homepage if not logged in, passing the data
        return view('frontend.Home', compact(
            'totalAlumni',
            'upcomingEvents',
            'eventsThisYear'
        ));
    }
}
