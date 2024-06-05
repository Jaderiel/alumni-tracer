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
        $this->deletePastEvents();
        $events = Event::all();
        $announcements = Announcement::all();

        foreach ($events as $event) {
            $event->event_date = Carbon::parse($event->event_date); // Convert string to DateTime object
        }

        return view("auth.events", compact('events', 'announcements'));
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

    public function addEvent() {
        return view('auth.add-event');
    }

    public function store(Request $request)
    {

        $request->validate([
            'event_title' => 'required',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048', // Adjust file type and size as needed
            'event_date' => 'required',
            'event_time' => 'required',
            'event_details' => 'required',
        ]);

        // Handle image upload
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $mediaUrl = 'images/'.$imageName;
        }

        $event = new Event();
        $event->event_title = $request->event_title;
        $event->media_url = $mediaUrl; // Use the $mediaUrl variable
        $event->event_details = $request->event_details;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->save();

        return redirect()->back()->with('success', 'Event created successfully!');

    }

    public function addAnn() {
        return view('auth.add-announcement');
    }

    public function storeAnn(Request $request)
    {

        $request->validate([
            'ann_title' => 'required',
            'ann_details' => 'required',
        ]);

        $ann = new Announcement();
        $ann->ann_title = $request->ann_title;
        $ann->ann_details = $request->ann_details;
        $ann->save();

        return redirect()->back()->with('success', 'Announcement created successfully!');

    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    public function edit($id) {
        $event = Event::findOrFail($id);

        return view("popups.update-event", compact('event'));

    }

    public function update(Request $request, Event $event)
    {
        // Handle image upload if a new file is uploaded
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $mediaUrl = 'images/'.$imageName;
            // Update media_url with the new file path
            $event->media_url = $mediaUrl;
        }

        // Update other fields
        $event->event_title = $request->input('event_title');
        $event->event_date = $request->input('event_date');
        $event->event_time = $request->input('event_time');
        $event->event_details = $request->input('event_details');
        // Save the updated event
        $event->save();

        // Redirect back to events page after updating
        return redirect()->back()->with('success', 'Event Edited successfully.');
    }

    public function editAnn($id) {

        $ann = Announcement::findOrFail($id);

        return view("popups.update-announcement", compact('ann'));

    }

    public function updateAnn(Request $request, Announcement $announcement)
    {

        // Update other fields
        $announcement->ann_title = $request->input('ann_title');
        $announcement->ann_details = $request->input('ann_details');
        // Save the updated event
        $announcement->save();

        // Redirect back to events page after updating
        return redirect()->back()->with('success', 'Announcement Edited successfully.');
    }

    public function deleteAnn($id)
    {
        $ann = Announcement::findOrFail($id);
        $ann->delete();

        return redirect()->route('events')->with('success', 'Announcement deleted successfully.');
    }

    public function deletePastEvents()
    {
        $now = Carbon::now();
        
        Event::where('event_date', '<', $now->toDateString())
            ->orWhere(function($query) use ($now) {
                $query->where('event_date', '=', $now->toDateString())
                    ->where('event_time', '<', $now->toTimeString());
            })
            ->delete();
    }


}
