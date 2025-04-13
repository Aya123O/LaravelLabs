<?php

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10); // Eager loading user
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Auth::user()->posts()->create($validated);
        return new PostResource($post);
    }
}
