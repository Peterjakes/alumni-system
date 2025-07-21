<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Display a list of all events for alumni (public page)
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('frontend.events.index', compact('events'));
    }

    // Admin only: Show create form
    public function create()
    {
        return view('backend.events.create');
    }

    // Admin only: Store new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Admin only: Show edit form
    public function edit(Event $event)
    {
        return view('backend.events.edit', compact('event'));
    }

    // Admin only: Update event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Admin only: Delete event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    // Alumni only: Register for event
    public function register(Event $event)
    {
        $user = Auth::user();

        if (!$user->registeredEvents->contains($event->id)) {
            $user->registeredEvents()->attach($event->id);
        }

        return redirect()->route('events.index')->with('success', 'You registered for the event.');
    }
}
