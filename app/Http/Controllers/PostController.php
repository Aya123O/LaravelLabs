<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Storage;
use App\Rules\MaxThreeComments;



class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::all(); //to get all posts
        //to display posts
        $posts = Post::paginate(30);
        //formated timestap
        // $now = Carbon::now();
        // $formattedDate = $now->format('D, d M Y');
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        //$post = Post::find($id);
        //$post = Post::findOrFail($id);
        $comments = $post->comments;

        return view('posts.show',[
            'post' => $post,
            'comments'=>$comments
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(StorePostRequest $request)
    {   
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validatedData['image'] = $path;
        }
        
    
        Post::create($validatedData);
        
        // dd($data);

        return to_route('posts.index');
    }
    public function edit(Post $post)
    {
        $users = User::all(); // to display users dynamic 
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }


  
    public function update(StorePostRequest $request, Post $post)
{
    $validatedData = $request->validated();
    
    if ($request->has('remove_image')) {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $validatedData['image'] = null;
    }
    
    if ($request->hasFile('image')) {
        
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        
        $validatedData['image'] = $request->file('image')->store('posts', 'public');
    }
    
    $post->update($validatedData);
    
    return to_route('posts.index')
        ->with('success', 'Post updated successfully');
}
    
    public function destroy(Post $post)
    {   $post->comments()->delete();
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return to_route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
    public function storeComment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'min:3', 'max:1000', new MaxThreeComments($post)]
        ]);
    
        $post->comments()->create([
            'comment' => $validated['comment']
        ]);
    
        return to_route('posts.show', $post)->with('success', 'Comment added!');
    }
   
}