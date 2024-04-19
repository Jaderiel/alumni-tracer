<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function index() {
        $gallery = Gallery::all();
        return view("auth.gallery", compact('gallery'));
    }

    public function create() {
        return view("add-gallery");
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'course' => 'required|string',
                'img_title' => 'required|string',
                'img_description' => 'required|string',
                'media_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $mediaUrl = null;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $mediaUrl = 'images/'.$imageName;
            }

            $gallery = new Gallery;
            $gallery->user_id = auth()->id();
            $gallery->course = $request->course;
            $gallery->img_title = $request->img_title;
            $gallery->img_description = $request->img_description;
            $gallery->media_url = $mediaUrl;
            $gallery->save();
    
            Session::flash('success', 'Post saved successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
    }
}
