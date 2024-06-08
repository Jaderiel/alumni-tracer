<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Session;
use App\Rules\ValidCourses;

class GalleryController extends Controller
{
    public function index() {
        $gallery = Gallery::where('is_approved', true)->get();

        return view("auth.gallery", compact('gallery'));
    }

    public function create() {
        return view("add-gallery");
    }

    public function store(Request $request) {

            // Validate request data
            $validatedData = $request->validate([
                'course' => ['required', new ValidCourses],
                'img_title' => 'required|string',
                'img_description' => 'required|string',
                'media_url' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            ]);
    
            // Handle image upload
            $mediaUrl = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $mediaUrl = 'images/'.$imageName;
            }
    
            // Create new Gallery instance and fill with validated data
            $gallery = new Gallery($validatedData);
            $gallery->user_id = auth()->id();
            $gallery->media_url = $mediaUrl;
    
            // Check if user is Super Admin or Admin and set is_approved accordingly
            $user = auth()->user();
            if ($user->user_type === 'Super Admin' || $user->user_type === 'Admin') {
                $gallery->is_approved = true;
                $message = 'Post Saved Successfully!';
            } else {
                $message = 'Post Saved Successfully! Please Wait For The Approval.';
            }
    
            // Save the Gallery instance
            $gallery->save();
    
            // Redirect back with success message
            return redirect()->back()->with('success', $message);

    }
    

    public function edit(Gallery $gallery) {
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType !== 'Super Admin' && $currentUserType !== 'Admin' && $gallery->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this gallery post.');
        }
        return view('popups.update-gallery', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        // Validate request data
        $validatedData = $request->validate([
            'img_title' => 'required|string',
            'course' => ['required', new ValidCourses],
            'img_description' => 'required|string',
            'media_url' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        // Handle image upload if a new file is uploaded
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $mediaUrl = 'images/'.$imageName;
            // Update media_url with the new file path
            $gallery->media_url = $mediaUrl;
        }

        // Update other fields
        $gallery->img_title = $validatedData['img_title'];
        $gallery->course = $validatedData['course'];
        $gallery->img_description = $validatedData['img_description'];

        // Save the updated event
        $gallery->save();

        // Redirect back to events page after updating
        return redirect()->back()->with('success', 'Gallery Edited Successfully!');
    }


    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType !== 'Super Admin' && $currentUserType !== 'Admin' && $gallery->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this gallery post.');
        }
        $gallery->delete();

        return redirect()->route('gallery')->with('success', 'Gallery deleted successfully.');
    }
}
