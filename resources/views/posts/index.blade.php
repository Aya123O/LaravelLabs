@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<x-layout>
   
</body>
   
       <div class="flex items-center border border-gray-300 rounded-lg p-2 mb-5">
        <input type="text" class="w-full px-4 py-2 text-gray-700 bg-white border-none rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Search...">
        <button class="ml-2 text-white bg-blue-500 p-2 rounded-md hover:bg-blue-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path d="M23 23l-6-6M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Z" />
            </svg>
        </button>
    </div>
       <div class="text-center">
           <a href="{{ route('posts.create') }}" class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
               Create Post
           </a>
       </div>


       <!-- Table Component -->
       <div class="mt-6 rounded-lg border border-gray-200">
           <div class="overflow-x-auto rounded-t-lg">
               <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                   <thead class="text-left">
                       <tr>
                           <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                           <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                           <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                           <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Slug</th>
                           <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                           <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                       </tr>
                   </thead>
                   <tbody class="divide-y divide-gray-200">
                    @foreach ($posts as $post)
                    <tr>
                        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $post->id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->title }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->user->name }}</td>
                            <td >{{ $post->slug }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{  $post->created_at}}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                            <a href="{{ route('posts.show',  $post->slug) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-400 rounded hover:bg-blue-500">View</a>
                            <a href="{{ route('posts.edit', $post['id']) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                            Edit
                            </a>

    
                            <form id="delete-form-{{ $post['id'] }}" 
                                action="{{ route('posts.destroy', $post['id']) }}" 
                                method="POST" 
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this post?')"
                                        class="inline-block px-4 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                   </tbody>
               </table>
           </div>


           <!-- Pagination -->
           {{ $posts->links('vendor.pagination.custom') }}  
       </div>
</x-layout>