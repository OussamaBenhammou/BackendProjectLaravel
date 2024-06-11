<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\post;
use App\Models\Like;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        //$posts = post::latest()->get();
        $posts = post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'required|string',
        ]);


        $post = new Post;
        $post->title = $request->title;
        $post->message = $request->content;
        $post->image = $request->image;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('index')->with('success', 'Post added successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }


    public function destroy($id)
    {

        if (!Auth::user()->is_admin) {
            abort(403, 'Only admins can delete posts');
        }

        $post = Post::findOrFail($id);
        $likes = Like::where('post_id', '=', $post->id)->delete();
        $post->delete();

        return redirect()->route('index')->with('status', 'Post deleted');
    }
}
