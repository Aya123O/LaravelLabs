<x-layout>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Create New Post</h2>
            </div>
            
            <div class="px-6 py-4">
            {{-- @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input
                            
                            name="title"
                            type="text"
                            id="title"
                            value="{{ old('title') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                            
                        >
                        @error('title')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Description Textarea -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            value="{{ old('description') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                        ></textarea>
                        @error('description')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                        
                    </div>
                    
                    <!-- Post Creator Select -->
                    <div class="mb-6">
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                        <select
                            name="user_id"
                            id="creator"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white"
                        >
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{$user->name}}</option>
                        @endforeach
                        </select>
                       
                        
                    </div>
                     
                    <div>
                        <label>Image:</label>
                        <input type="file" name="image" accept=".jpg,.png">
                    </div>
                    <button type="submit">Save</button>
            
                <button type="submit">Save</button>
                    @error('user_id')
                    <small style="color:red">{{ $message }}</small>
                   @enderror
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hover:cursor-pointer"
                        >
                            Submit
                        </button>
                    </div>
            </form>
            </div>
          
            
        </div>
    </div>
</x-layout> 