@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

   
@endsection

<x-layout>
    <div class="max-w-3xl mx-auto space-y-6">
    
        <!-- Post Info Card -->
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Title: <span class="font-normal">{{ $post->title }}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Description: <span class="text-gray-600">{{ $post->description }}</span></h3>
                   
                </div>
            </div>
        </div>

        <!-- Post Creator Info Card -->
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Creator Info</h2>
            </div>
            {{-- @dd($post) --}}
            <div class="px-4 py-4">
                <div class="mb-2 d-flex">
                    <span class="text-lg font-medium text-gray-800">Image:</span>
                    @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="200">
                    {{-- {{ $post->image }} --}}
    
                    @else
                    <p>No image</p>
                  @endif
                </div>
                   
               
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Name: <span class="font-normal">{{ $post->user->name }}</span></h3>
                </div>
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Email: <span class="font-normal">{{ $post->user->email }}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Created At: <span class="font-normal">{{ $post->created_at }}</span></h3>
                </div>
            </div>
        </div>
<!-- comments  -->
        <div class="bg-white rounded border border-gray-200 p-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
            <p class="text-lg text-gray-700 leading-relaxed mb-6">{{ $post->content }}</p>
            
            <!-- Display Comments -->
            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Comments:</h3>
            @foreach($comments as $comment)
                <div class="comment bg-gray-100 p-4 mb-4 border border-gray-300 rounded-md">
                    <p class="text-lg text-gray-700">{{ $comment->comment }}</p>
                </div>
            @endforeach

            <!-- Add Comment Form -->
<form method="POST" action="{{ route('posts.comments.store', $post) }}">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 mb-2">Add Comment</label>
                    <textarea name="comment" id="comment" rows="3" 
                        class="w-full px-3 py-2 border rounded-md" required></textarea>
                </div>
                @error('comment')
                <small class="text-red-500">{{ $message }}</small> <br>
            @enderror
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                    Submit Comment
                </button>
            </form>
        </div>


        <!-- Action Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Back to All Posts
            </a>
            <div class="space-x-2">
                <a href="{{ route('posts.edit', $post->id) }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Edit Post
                </a>
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this post?')"
                            class="px-4 py-2 bg-red-600 text-white font-medium rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
