<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationConfirmation;


class EventController extends Controller
{
    // Frontend events listing for alumni and public
  public function index()
{
    $events = Event::where('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->get();

    return view('frontend.events.index', compact('events'));
}


    public function adminIndex()
    {
        $events = Event::latest()->paginate(10);
        return view('backend.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('frontend.events.show', compact('event'));
    }

    
    public function create()
    {
        return view('backend.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('backend.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_url) {
                Storage::disk('public')->delete($event->image_url);
            }
            $data['image_url'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->image_url) {
            Storage::disk('public')->delete($event->image_url);
        }
        
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }


public function register(Request $request, Event $event)
{
    $user = auth()->user();

    // Prevent duplicate registration
    if ($user->registeredEvents()->where('event_id', $event->id)->exists()) {
        return redirect()->back()->with('error', 'You are already registered for this event.');
    }

    // Register user
    $user->registeredEvents()->attach($event->id, ['registered_at' => now()]);

    // Send email
    Mail::to($user->email)->send(new EventRegistrationConfirmation($event));

    return redirect()->back()->with('success', 'Successfully registered for the event! A confirmation email has been sent.');
}

}
