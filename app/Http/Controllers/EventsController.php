<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Announcement;
use App\Models\EventRegistration;
use Carbon\Carbon;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    private function logActivity($action, $description)
    {
        ActivityLogHelper::log(Auth::id(), $action, $description);
    }

    public function events()
    {
        $this->deletePastEvents();
        $events = Event::where('inactive', false)->get();
        $announcements = Announcement::where('inactive', false)->get();

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

    // Get the event title
    $eventTitle = Event::where('id', $event_id)->value('event_title');

    // Log the activity
    $this->logActivity('Event Registration', "User ID: $user_id registered for Event: $eventTitle");

    // Optionally, you can redirect the user or return a response
    return redirect()->back()->with('success', 'Registration Successful');
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

    public function addEvent()
    {
        return view('auth.add-event');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_title' => 'required',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
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
        $event->media_url = $mediaUrl;
        $event->event_details = $request->event_details;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->save();

        // Log the activity
        $activityDescription = 'Created event: ' . $event->event_title . ', Media URL: ' . asset($mediaUrl);
        $this->logActivity('Created an event', $activityDescription);

        return redirect()->back()->with('success', 'Event Created Successfully!');
    }

    public function addAnn()
    {
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType !== 'Super Admin' && $currentUserType !== 'Admin' && $currentUserType !== 'Program Head' && $currentUserType !== 'Alumni Officer') {
            return redirect()->back()->with('error', 'You are not authorized to add announcements.');
        }
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

        // Log the activity
        $activityDescription = 'Created announcement: ' . $ann->ann_title;
        $this->logActivity('Created an announcement', $activityDescription);

        return redirect()->back()->with('success', 'Announcement Created Successfully!');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);

        $currentUserType = auth()->user()->user_type;
        if ($currentUserType == 'Alumni' && $event->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this event.');
        }

        // Log the activity
        $activityDescription = 'Event Archived: ' . $event->event_title;
        $this->logActivity('Event Archived', $activityDescription);

        $event->inactive = true;
        $event->save();

        return redirect()->back()->with('success', 'Event Archived Successfully.');
    }

    public function edit($id)
    {
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType == 'Alumni') {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }

        $event = Event::findOrFail($id);

        return view("popups.update-event", compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_details' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the original values for comparison
        $originalTitle = $event->event_title;
        $originalMediaUrl = $event->media_url;

        // Update the event with the new values
        $event->event_title = $request->input('event_title');
        $event->event_date = $request->input('event_date');
        $event->event_time = $request->input('event_time');
        $event->event_details = $request->input('event_details');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $mediaUrl = 'images/'.$imageName;
            $event->media_url = $mediaUrl;
        }

        $event->save();

        // Construct the log message
        $activityDescription = 'Updated event: ' . $event->event_title;
        if (isset($mediaUrl) && $mediaUrl !== $originalMediaUrl) {
            $activityDescription .= ', Media URL updated to ' . asset($mediaUrl);
        }

        // Log the activity
        $this->logActivity('Updated an event', $activityDescription);

        return redirect()->back()->with('success', 'Event Updated Successfully!');
    }

    public function editAnn($id)
    {
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType == 'Alumni') {
            return redirect()->back()->with('error', 'You are not authorized to edit announcements.');
        }

        $ann = Announcement::findOrFail($id);

        return view("popups.update-announcement", compact('ann'));
    }

    public function updateAnn(Request $request, Announcement $announcement)
    {
        $request->validate([
            'ann_title' => 'required|string|max:255',
            'ann_details' => 'required|string',
        ]);

        $activityDescription = 'Updated announcement: ' . $announcement->ann_title;

        // Update other fields
        $announcement->ann_title = $request->input('ann_title');
        $announcement->ann_details = $request->input('ann_details');
        $announcement->save();

        // Log the activity
        $this->logActivity('Updated an announcement', $activityDescription);

        // Redirect back to events page after updating with success message
        return redirect()->back()->with('success', 'Announcement Edited Successfully!');
    }

    public function deleteAnn($id)
    {
        $ann = Announcement::findOrFail($id);

        // Log the activity
        $activityDescription = 'Announcement is set as inactive: ' . $ann->ann_title;
        $this->logActivity('Announcement is set as inactive', $activityDescription);

        $ann->inactive = true;
        $ann->save();

        return redirect()->route('events')->with('success', 'Announcement is set as inactive!');
    }

    public function deletePastEvents()
    {
        $now = Carbon::now();
        
        $pastEvents = Event::where('event_date', '<', $now->toDateString())
            ->orWhere(function($query) use ($now) {
                $query->where('event_date', '=', $now->toDateString())
                    ->where('event_time', '<', $now->toTimeString());
            })
            ->get();

        foreach ($pastEvents as $event) {
            // Log the activity
            $activityDescription = 'Deleted past event: ' . $event->event_title;
            $this->logActivity('Deleted a past event', $activityDescription);
            
            $event->inactive = true;
            $event->save();
        }
    }
}
