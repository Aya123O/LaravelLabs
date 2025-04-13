<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>ITI Blog Post</title>
   @vite(['resources/css/app.css'])
   <!-- Add Inter font for better typography -->
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
   <style>
       body {
           font-family: 'Inter', sans-serif;
       }
       /* Smooth transitions for interactive elements */
       a, button {
           transition: all 0.2s ease;
       }
   </style>
</head>

<body class="bg-gray-50">
   <!-- Enhanced Navigation -->
   <nav class="bg-white shadow-md sticky top-0 z-50">
       <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           <div class="flex justify-between h-16 items-center">
               <div class="flex">
                   <div class="flex-shrink-0 flex items-center">
                       <a class="text-xl font-bold text-gray-800 hover:text-blue-600" href="#">
                           ITI Blog Post
                       </a>
                   </div>
                   <div class="ml-6 flex items-center space-x-1">
                       <a class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 border-b-2 border-blue-500 hover:border-blue-600" href="{{route('posts.index')}}">
                           All Posts
                       </a>
                   </div>
               </div>
               <div class="flex items-center">
                   <button type="button" class="md:hidden flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                       </svg>
                   </button>
               </div>
           </div>
       </div>
   </nav>

   <!-- Enhanced Container -->
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </div>
</body>
</html>