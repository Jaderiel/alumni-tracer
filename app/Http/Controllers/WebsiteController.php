<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Job;
use App\Models\User;

class WebsiteController extends Controller
{
    public function index() {

        $eventCount = Event::count();
        $jobCount = Job::where('is_approved', true)->count();
        $verifiedAlumniCount = User::where('is_email_verified', true)
            ->where('user_type', 'Alumni')
            ->count();

        return view("website.home", compact('verifiedAlumniCount', 'eventCount', 'jobCount',));
    }

    public function about() {
        return view("website.about");
    }

    public function ver() {
        return view("website.ver");
    }

    public function services() {
        return view("website.services");
    }

    public function main() {
        return view("main");
    }

    public function privacyNotice() {
        return view("website.privacy-notice");
    }

    public function userGuide() {
        return view("website.user-guide");
    }
}
