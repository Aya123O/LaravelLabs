<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

// Protected routes using Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);       // Get all posts
    Route::get('/posts/{id}', [PostController::class, 'show']);   // Get one post
    Route::post('/posts', [PostController::class, 'store']);      // Store a new post
});
