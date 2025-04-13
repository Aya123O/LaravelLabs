<x-layout>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Post</h2>
            </div>
            
            <div class="px-6 py-4">
                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input
                            name="title"
                            type="text"
                            id="title"
                            value="{{ old('title', $post->title) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                        >
                        @error('title')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Description Textarea -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                        >{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Post Creator Select -->
                    <div class="mb-4">
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                        <select
                            name="user_id"
                            id="creator"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white"
                        >
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == old('user_id', $post->user_id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                     
                    <!-- Current Image Display -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                        @if($post->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Current post image" class="h-40">
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="remove_image" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2">Remove current image</span>
                                    </label>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No image uploaded</p>
                        @endif
                    </div>
                    
                    <!-- New Image Upload -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">New Image (Optional)</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept=".jpg,.png"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                        >
                        @error('image')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        >
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>