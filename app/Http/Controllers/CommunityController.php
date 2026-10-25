<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Siguraduhing naka-import ang Post model

class CommunityController extends Controller
{
    // 1. Ipakita ang listahan ng mga posts (Blangko kung walang laman)
    public function index()
    {
        $posts = Post::all();
        return view('community-information', compact('posts'));
    }

    // 2. Mag-save ng bagong post mula sa "+ Create New Post" modal
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string', // Announcement o Events
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
        ]);

        return redirect()->route('community.information')->with('success', 'Post created successfully!');
    }

    // 3. Mag-delete ng post para hindi na bumalik pagka-refresh
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('community.information')->with('success', 'Post deleted successfully!');
    }
}