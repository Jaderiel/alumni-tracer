<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Announcement;
use App\Models\EventRegistration;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function events() {

        $events = Event::all();
        $announcements = Announcement::all();

        foreach ($events as $event) {
            $event->event_date = Carbon::parse($event->event_date); // Convert string to DateTime object
        }

        return view("auth.events", compact('events', 'announcements', 'event'));
    }
    
    public function register($user_id, $event_id)
    {
        $existingRegistration = EventRegistration::where('user_id', $user_id)
                                                ->where('event_id', $event_id)
                                                ->first();

        if ($existingRegistration) {
            // User is already registered, show an error message
            return redirect()->back()->with('error', 'You are already registered for this event');
        }
        // Create a new event registration record
        $registration = EventRegistration::create([
            'user_id' => $user_id,
            'event_id' => $event_id,
        ]);

        // Optionally, you can redirect the user or return a response
        return redirect()->back()->with('success', 'Registration successful');
    }

    public function getRegisteredUsers($eventId)
    {
        // Fetch the event title for the specified event ID
        $eventTitle = Event::where('id', $eventId)->value('event_title');

        // Fetch all the user IDs registered for the specified event
        $registeredUserIds = EventRegistration::where('event_id', $eventId)->pluck('user_id');

        // Fetch user objects associated with the user IDs, including course and batch information
        $registeredUsers = User::whereIn('id', $registeredUserIds)->get(['first_name', 'last_name', 'course', 'batch', 'email', 'id']);

        // Transform user objects to include full name
        $registeredUsersWithInfo = $registeredUsers->map(function($user) {
            $user->full_name = $user->first_name . ' ' . $user->last_name;
            return $user;
        });

        // Return the event title and registered users with course and batch information to the view
        return view('popups.event-registration')->with([
            'eventTitle' => $eventTitle,
            'registeredUsers' => $registeredUsersWithInfo,
        ]);
    }

}
