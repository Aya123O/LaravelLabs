@props(['href'])

<form action="{{ $href }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" 
            onclick="return confirm('Are you sure you want to delete this post?')"
            class="inline-block px-4 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none">
        Delete
    </button>
</form>