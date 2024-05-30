<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index() {
        return view("website.home");
    }

    public function about() {
        return view("website.about");
    }

    public function services() {
        return view("website.services");
    }

    public function main() {
        return view("main");
    }
}
