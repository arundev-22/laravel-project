<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function home()
    {
        return view('post.home');
    }

    public function register()
    {
        return view('post.register');
    }

    // public function index()
    // {
    //     $posts = Post::with('user')->latest()->get();
    //     return view('post.dashboard', compact('posts'));
    // }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $followingIds = $user->followings()->where('request_approved', true)->pluck('users.id');
                            
        $followingIds->push($user->id);

        $posts = Post::with(['user', 'comments.user'])->whereIn('user_id', $followingIds)->latest()->get();
                    
        return view('post.dashboard', compact('posts'));
    }


    public function user()
    {
        $users = User::all();
        return view('post.user', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'title'   => 'required',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
        'user_id' => Auth::id(), 
        'title'   => $request->title,
        'content' => $request->content,
        'image'   => $imagePath, 

        ]);

        return redirect()->route('post.dashboard')->with('success', 'Post created successfully!');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
