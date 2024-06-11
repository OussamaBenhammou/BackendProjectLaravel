<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\post;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function like($postId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to like a post.');
        }

        $post = Post::findOrFail($postId);

        $existingLike = Like::where('post_id', $post->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return redirect()->back()->with('success', 'You unliked the post.');
        } else {
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->post_id = $post->id;
            $like->save();
            return redirect()->back()->with('success', 'You liked the post.');
        }
    }
}
