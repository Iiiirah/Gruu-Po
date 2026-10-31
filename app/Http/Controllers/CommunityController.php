<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    /**
     * Display a listing of the community posts (Admin side).
     */
    public function index()
    {
        $posts = Announcement::latest()->get();
        return view('community-information', compact('posts'));
    }

    /**
     * Display posts for the Resident side.
     */
    public function residentIndex()
    {
        $posts = Announcement::latest()->get();
        return view('resident-community-information', compact('posts'));
    }

    /**
     * Store a newly created community post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Announcement,Events',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('community_images', 'public');
        }

        Announcement::create([
            'title' => $request->title,
            'type' => $request->type,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Post created successfully.');
    }

    /**
     * Update the specified community post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Announcement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Announcement,Events',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $post->image;

        if ($request->has('remove_image') && $request->remove_image == 1) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = null;
        } elseif ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('community_images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'type' => $request->type,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('community.information')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified community post from storage.
     */
    public function destroy($id)
    {
        $post = Announcement::findOrFail($id);
        
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('community.information')->with('success', 'Post deleted successfully.');
    }
}