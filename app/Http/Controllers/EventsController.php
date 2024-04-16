<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Announcement;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function events() {

        $events = Event::all();
        $announcements = Announcement::all();

        foreach ($events as $event) {
            $event->event_date = Carbon::parse($event->event_date); // Convert string to DateTime object
        }

        return view("auth.events", compact('events', 'announcements'));
    }
}
