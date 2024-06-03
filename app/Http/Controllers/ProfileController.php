<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() {   
        $user = auth()->user()->load('employment');
        $userId = $user->id;

        return view("auth.user-profile", compact('user', 'userId'));
    }

    public function show($id)
    {
        $user = User::find($id);

        // Pass the user data to the view
        return view('auth.show-profile', ['user' => $user]);
    }

}
