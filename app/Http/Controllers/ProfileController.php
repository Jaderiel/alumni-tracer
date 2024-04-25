<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() {
        return view("auth.user-profile");
    }

    public function show($id)
    {
        $user = User::find($id);

        // Pass the user data to the view
        return view('auth.show-profile', ['user' => $user]);
    }

}
