<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function jobs() {
        return view("auth.jobs");
    }

    public function jobPost() {
        return view("job-post");
    }
}
